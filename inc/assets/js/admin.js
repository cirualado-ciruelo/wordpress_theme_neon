/*
 * Admin scripts.
 */

'use strict';

(function($) {
  const BODY = document.querySelector('body');
  const BODYCLASS = BODY.classList;
  const $BODY = $('body');
  const USER_AGENT = document.documentElement.dataset.ua;

  /*
   * 関数実行
   */
  // hoge();

  addEventListener('load', function() {
    hoge();
  });

  addEventListener('resize', function() {
    hoge();
  });

  function hoge() {
    
  }

  // if ( isBodyClass('single') ) {
  //   console.log('single!');
  // }

  /**
   * bodyのクラス名から特定のクラスを判定
   *
   * @param {Strings}
   * @return {Boolean}
   */
  function isTouchDevice(className) {
    if ( 'ontouchstart' in document.documentElement ) {
      $BODY.addClass('-touch');
    }
  }

  /**
   * bodyのクラス名から特定のクラスを判定
   *
   * @param {Strings}
   * @return {Boolean}
   */
  function isBodyClass(className) {
    return BODYCLASS.contains(className);
  }
}(jQuery));
