// usage: log('inside coolFunc', this, arguments);
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console) {
      arguments.callee = arguments.callee.caller;
      console.log( Array.prototype.slice.call(arguments) );
  }
};
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();)b[a]=b[a]||c})(window.console=window.console||{});

(function(c){c.fn.extend({defaultValue:function(e){if("placeholder"in document.createElement("input"))return!1;return this.each(function(){if(c(this).data("defaultValued"))return!1;var a=c(this),h=a.attr("placeholder"),f={input:a};a.data("defaultValued",!0);var d=function(){var b;if(a.context.nodeName.toLowerCase()=="input")b=c("<input />").attr({type:"text"});else if(a.context.nodeName.toLowerCase()=="textarea")b=c("<textarea />");else throw"DefaultValue only works with input and textareas";b.attr({value:h,
"class":a.attr("class")+" empty",size:a.attr("size"),style:a.attr("style"),tabindex:a.attr("tabindex"),rows:a.attr("rows"),cols:a.attr("cols"),name:"defaultvalue-clone-"+((1+Math.random())*65536|0).toString(16).substring(1)});b.focus(function(){b.hide();a.show();setTimeout(function(){a.focus()},1)});return b}();f.clone=d;d.insertAfter(a);var g=function(){a.val().length<=0?(d.show(),a.hide()):(d.hide(),a.show().trigger("click"))};a.bind("blur",g);g();e&&e(f)})}})})(jQuery);