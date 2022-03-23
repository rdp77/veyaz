"use strict";

(function (NioApp, $) {
  'use strict'; // Basic

  dragula([document.querySelector("#basicLeft"), document.querySelector("#basicRight")]); // Basic with list

  dragula([document.querySelector("#basicLeftList"), document.querySelector("#basicRightList")]); // Theme

  dragula([document.querySelector("#themeLeft"), document.querySelector("#themeRight")]).on('drag', function (el) {
    el.className = el.className.replace('bg-white', '');
  }).on('drop', function (el) {
    el.className += ' bg-warning-dim';
  }); // Remove on Spill

  dragula([document.querySelector("#removeSpillLeft"), document.querySelector("#removeSpillRight")], {
    removeOnSpill: true
  }); // Not Remove Spill

  dragula([document.querySelector("#not-removeSpillLeft"), document.querySelector("#not-removeSpillRight")], {
    removeOnSpill: false
  }); // Copy spill Both

  dragula([document.querySelector("#both-copySpillLeft"), document.querySelector("#both-copySpillRight")], {
    copy: true
  }); // Copy spill aside

  dragula([document.querySelector("#aside-copySpillLeft"), document.querySelector("#aside-copySpillRight")], {
    copy: function copy(el, source) {
      return source === document.querySelector("#aside-copySpillLeft");
    },
    accepts: function accepts(el, target) {
      return target !== document.querySelector("#aside-copySpillLeft");
    }
  }); // Drag Handle 

  dragula([document.querySelector("#dragHandleLeft"), document.querySelector("#dragHandleRight")], {
    moves: function moves(el, container, handle) {
      return handle.classList.contains('handle');
    }
  }); // Drag Container

  dragula([document.querySelector("#dragContainer")]);
})(NioApp, jQuery);