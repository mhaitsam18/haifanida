(function(e){e.fn.appear=function(a,c){var t=e.extend({data:void 0,one:!0,accX:0,accY:0},c);return this.each(function(){var r=e(this);if(r.appeared=!1,!a){r.trigger("appear",t.data);return}var f=e(window),n=function(){if(!r.is(":visible")){r.appeared=!1;return}var l=f.scrollLeft(),p=f.scrollTop(),u=r.offset(),o=u.left,d=u.top,s=t.accX,h=t.accY,v=r.height(),m=f.height(),g=r.width(),w=f.width();d+v+h>=p&&d<=p+m+h&&o+g+s>=l&&o<=l+w+s?r.appeared||r.trigger("appear",t.data):r.appeared=!1},i=function(){if(r.appeared=!0,t.one){f.unbind("scroll",n);var l=e.inArray(n,e.fn.appear.checks);l>=0&&e.fn.appear.checks.splice(l,1)}a.apply(this,arguments)};t.one?r.one("appear",t.data,i):r.bind("appear",t.data,i),f.scroll(n),e.fn.appear.checks.push(n),n()})},e.extend(e.fn.appear,{checks:[],timeout:null,checkAll:function(){var a=e.fn.appear.checks.length;if(a>0)for(;a--;)e.fn.appear.checks[a]()},run:function(){e.fn.appear.timeout&&clearTimeout(e.fn.appear.timeout),e.fn.appear.timeout=setTimeout(e.fn.appear.checkAll,20)}}),e.each(["append","prepend","after","before","attr","removeAttr","addClass","removeClass","toggleClass","remove","css","show","hide"],function(a,c){var t=e.fn[c];t&&(e.fn[c]=function(){var r=t.apply(this,arguments);return e.fn.appear.run(),r})})})(jQuery);(function(e){e.fn.countTo=function(a){a=e.extend({},e.fn.countTo.defaults,a||{});var c=Math.ceil(a.speed/a.refreshInterval),t=(a.to-a.from)/c;return e(this).each(function(){var r=this,f=0,n=a.from,i=setInterval(l,a.refreshInterval);function l(){n+=t,f++,e(r).html(n.toFixed(a.decimals)),typeof a.onUpdate=="function"&&a.onUpdate.call(r,n),f>=c&&(clearInterval(i),n=a.to,typeof a.onComplete=="function"&&a.onComplete.call(r,n))}})},e.fn.countTo.defaults={from:0,to:100,speed:1e3,refreshInterval:100,decimals:0,onUpdate:null,onComplete:null}})(jQuery);