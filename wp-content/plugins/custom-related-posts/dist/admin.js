var CustomRelatedPosts="object"==typeof CustomRelatedPosts?CustomRelatedPosts:{};CustomRelatedPosts.admin=function(t){var e={};function r(o){if(e[o])return e[o].exports;var n=e[o]={i:o,l:!1,exports:{}};return t[o].call(n.exports,n,n.exports,r),n.l=!0,n.exports}return r.m=t,r.c=e,r.d=function(t,e,o){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(r.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(o,n,function(e){return t[e]}.bind(null,n));return o},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="",r(r.s=92)}({33:function(t,e,r){"use strict";(function(t){r(49),r(50);t(document).ready(function(t){t("#crp_meta_box").length>0&&o.initMetaBox()});var o={post_id:void 0,search_term_field:void 0,search_button:void 0,initMetaBox:function(){o.post_id=t("#crp_post").val(),o.search_term_field=t("#crp_search_term"),o.search_button=t("#crp_search_button"),o.search_button.on("click",function(){o.searchPosts()}),o.search_term_field.on("keydown",function(t){13==t.keyCode&&(t.preventDefault(),t.stopPropagation(),o.searchPosts())}),t("#crp_relations").on("click",".crp_remove_relation",function(){o.removeRelation(t(this))}),t("#crp_search_results_table").on("click","button",function(t){t.preventDefault(),t.stopPropagation()})},removeRelation:function(e){var r=e.hasClass("crp_remove_relation_both"),n=e.hasClass("crp_remove_relation_to"),i=e.hasClass("crp_remove_relation_from"),a=e.parent("div").data("post");if(void 0==a)if(a=e.parents("tr").data("post"),n){var s=e.parents("tr").find("td").first().text(),_='<div id="crp_related_post_'+a+'" data-post="'+a+'">'+crp_admin.remove_image_from+s+"</div>";t("#crp_relations_single_from").prepend(_)}else if(i){_='<div id="crp_related_post_'+a+'" data-post="'+a+'">'+(s=e.parents("tr").find("td").first().text())+crp_admin.remove_image_to+"</div>";t("#crp_relations_single_to").prepend(_)}t("#crp_related_post_"+a).remove();var c={action:"crp_remove_relation",security:crp_admin.nonce,base:o.post_id,target:a,from:r||i,to:r||n};t.post(crp_admin.ajax_url,c)},searchPosts:function(){t(".crp_search_results").slideUp(250),o.search_button.addClass("crp_spinner");var e=o.search_term_field.val();if(0==e.length)o.search_button.removeClass("crp_spinner"),t("#crp_search_results_input").slideDown(500),o.search_term_field.focus();else{var r={action:"crp_search_posts",security:crp_admin.nonce,term:e,base:o.post_id};t.post(crp_admin.ajax_url,r,function(e){o.search_button.removeClass("crp_spinner"),0==e.length?(t("#crp_search_results_none").slideDown(500),o.search_term_field.focus()):t("#crp_search_results_table").slideDown(500).find("tbody").html(e)},"html")}},linkTo:function(e){o.addLink(e,!1,!0),o.disableActions(e,!1);var r='<div id="crp_related_post_'+e+'" data-post="'+e+'">'+t("#crp_post_"+e+"_title").text()+crp_admin.remove_image_to+"</div>";t("#crp_relations_single_to").append(r)},linkFrom:function(e){o.addLink(e,!0,!1),o.disableActions(e,!1);var r=t("#crp_post_"+e+"_title").text(),n='<div id="crp_related_post_'+e+'" data-post="'+e+'">'+crp_admin.remove_image_from+r+"</div>";t("#crp_relations_single_from").append(n)},linkBoth:function(e){o.addLink(e,!0,!0),o.disableActions(e,!0),t("#crp_related_post_"+e).remove();var r=t("#crp_post_"+e+"_title").text(),n='<tr id="crp_related_post_'+e+'" data-post="'+e+'"><td>'+r+crp_admin.remove_image_to+'</td><td><div class="crp_link">'+crp_admin.remove_image_both+"</div></td><td>"+crp_admin.remove_image_from+r+"</td></tr>";t("#crp_relations_both").append(n)},disableActions:function(e,r){t("#crp_post_"+e+"_actions").find("button").each(function(t,e){(r||1!=t)&&(e.disabled=!0)})},addLink:function(e,r,n){var i={action:"crp_link_posts",security:crp_admin.nonce,base:o.post_id,target:e,from:r,to:n};t.post(crp_admin.ajax_url,i)}};e.a=o}).call(this,r(48))},47:function(t,e){},48:function(t,e){t.exports=window.jQuery},49:function(t,e){},50:function(t,e){},92:function(t,e,r){"use strict";r.r(e);r(47);var o=r(33);r.d(e,"Metabox",function(){return o.a})}});