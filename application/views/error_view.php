<style>
div.cli {
  background: black;
  height: 300px;
  color: white;
  font-family: "courier new", monospace;
  font-size: 12px;
  padding: 10px;
  overflow: hidden;
  border:solid 2px #555;
}
div.cli div.spacer {
  height: 308px;
}
div.cli span.command:before {
  content: "anonymous@hts:~$ ";
}
div.cli .line {
  display: block;
}
div.cli .line:after {
  content: "\00a0";
}
div.cli .line:last-child:after {
  content: "\00a0";
  width:7px;
  height:14px;
  background:white;
}
</style>

<div class="uk-alert uk-alert-danger uk-text-center">
  <h1>four o' four</h1>
  You have come to a page that is no more!  It has ceased to be!
</div>

<div class='cli'>
  <div class='spacer'>&nbsp;</div>
  <span class='command line'>curl -s -D - <%=url%> -o /dev/null</span>
</div>

<script type="text/javascript" charset="utf-8">
(function(global, _) {
  "use strict";

  function CommandTyper(element) {
    this.element = element;
    this.command = '';
    this.offset = 0;
    this.init();
  }
  CommandTyper.prototype = {
    init: function() {
      this.command = _(this.element.textContent).template({url:global.location});
      this.element.textContent = '';
    },
    start: function(finish_callback) {
      this._finish = finish_callback || function(){};
      this.element.classname = _(this.element.className.split(' ').concat('active')).uniq().join(' ');
      this.step();
    },
    finish: function() {
      this._finish();
    },
    type: function() {
      var letter = this.command[this.offset++];
      if (typeof letter !== 'undefined') {
        this.element.textContent += letter;
      }
      return letter;
    },
    step: function(misstype) {
      if (misstype) {
        return this.misstype();
      }
      var letter = this.type();

      if (typeof letter !== 'undefined') {
        this.resetTimer(letter);
      } else {
        this.finish();
      }
    },
    resetTimer: function(letter) {
      var me = this;
      global.setTimeout(function() {
        var misstype = false;
        if ('-:/. '.indexOf(letter) >= 0) {
          if ((global.Math.random() * 100) > 90) {
            misstype = true;
          }
        }

        me.step(misstype);
      }, global.Math.random() * 300);
    },
    misstype: function() {
      var offset = this.offset, letter = this.command[offset], me = this;
      do {
        this.offset = Math.floor(global.Math.random() * offset);
      } while (this.command[this.offset] == letter);
      this.type();
      this.offset = offset;

      global.setTimeout(function() {

        var content = me.element.textContent;
        me.element.textContent = content.substr(0, content.length - 1);
        global.setTimeout(function() {
          me.resetTimer('a');
        }, 250);
      }, 250);
    }
  };

  function CLI() {
    this.element = global.document.querySelector('div.cli');
    this.init();
  }
  CLI.prototype = {
    init: function() {
      var me = this;
      me.currentLine = this.element.querySelector('span.command');
      me.commandTyper = new CommandTyper(me.currentLine);
      me.commandTyper.start(function(){
        me.addLine();
        me.startOutput();
      });
      this.element.scrollTop = this.element.scrollHeight;
    },
    addLine: function(content, force) {
      var line;
      if (force === true || this.currentLine.textContent !== '') {
        line = global.document.createElement('span');
        line.className = 'line';
        this.element.appendChild(line);
        this.currentLine = line;
      }
      this.currentLine.textContent = content || "";
      this.element.scrollTop = this.element.scrollHeight;
      return this.currentLine;
    },
    startOutput: function() {
      var me = this;
      _.defer(function() {
        var request = new global.XMLHttpRequest(), headers;
        request.open('GET', global.location, false);
        request.send(null);
        headers = request.getAllResponseHeaders().split("\n");
        me.addLine(['HTTP/1.1', request.status, request.statusText].join(' '));
        _(headers).each(function(line) {
          me.addLine(line);
        });
        me.addLine();
        var line = me.addLine('', true);
        line.className = 'line command';
      }, 500);
    }
  };

  new CLI();
}(this, _));
</script>
