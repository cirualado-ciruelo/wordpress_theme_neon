/*
 * Theme scripts.
 */

'use strict';

(function($) {
  const BODY = document.querySelector('body');
  const BODYCLASS = BODY.classList;
  const $BODY = $('body');
  const $SITE_HEADER = $('.Header');
  const USER_AGENT = document.documentElement.dataset.ua;
  const MAIN_CONTENT_WIDTH = 1080;

  // alert(innerWidth)

  /*
   * 関数実行
   */
  objectFitImages('[data-lib="ofi"]');
  customizeMwForm();
  click();

  addEventListener('load', function() {
    contentTable();
    scroll();
    isTouchDevice();
    swiper()
  });

  addEventListener('resize', function() {

  });

  /**
   * Swiper
   */
  function swiper() {

    /**
     * スライドをホバーしたらautoplayを止める
     */
    function stopSlideHover(type, wrp) {
      $(wrp+' .swiper-container').hover(function() {
        type.autoplay.stop();
      }, function() {
        type.autoplay.start();
      });
    }

    /*
     * 1秒後にcontainerを表示
     */
    if ( $('.swiper-container')[0] ) {
      $('.swiper-container').delay(1000).animate({'opacity': 1}, 200);
      $('.swiper_config').addClass('-loaded');
    }

    if ( $('[data-lib="swiper_1"]')[0] ) {
      const swiper_1 = new Swiper('[data-lib="swiper_1"] .swiper-container', {
        pagination: {
          el: '[data-lib="swiper_1"] .swiper-pagination',
          type: 'bullets',
          clickable: true
        },
        navigation: {
          nextEl: '[data-lib="swiper_1"] .swiper-button-next',
          prevEl: '[data-lib="swiper_1"] .swiper-button-prev',
        },
        paginationClickable: true,
        spaceBetween: 100,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false
        },
        speed: 1000,
        slidesPerView: 1,
        loop: true
      });

      stopSlideHover(swiper_1, '[data-lib="swiper_1"]');
    }
  }

  /**
   * WordPressプラグイン
   * MW WP FORMのカスタマイズ
   */
  function customizeMwForm() {
    const cfg = {
      errorScrollOfset: 15,
      confirmDirName: 'confirm'
    }

    /*
     * エラー項目があったらその地点までスクロールする
     */
    if ( $('.mw_wp_form .error')[0] ) {
      const $errorItem = $('.mw_wp_form .error').eq(0);
      const $errorItemPos = $errorItem.parent().offset().top;
      const $siteHeaderH = $SITE_HEADER.height();

      $('body').addClass('form_error');

      $('select + .error').each(function() {
        $(this).appendTo($(this).parent().parent());
      });

      $('body, html')
      .animate({
        scrollTop: $errorItemPos - $siteHeaderH + cfg.errorScrollOfset
      }, 600, 'swing');
    }

    /*
     * 確認画面でパラメーターを削除
     * ※コンバージョン計測時にややこしくなるのを防ぐため
     */
    $('.mw_wp_form [name="submit"]').click(function() {
      history.replaceState('', '', confirmDirName);
    });

    /*
     * カレンダーフィールドのテキスト再編集防止用
     */
    if ( $('.wp_MwCalendar')[0] ) {
      $('.wp_MwCalendar').attr('readonly', true);
    }
  }

  /**
   * scroll function
   */
  function scroll() {
    const a = 'anyTimingToggle';
    const cfg = {
      a: {
        timing: 500
      }
    }

    function el(e) {
      return $('[data-scroll="'+e+'"]');
    }

    function callbak() {
      const $st = $(window).scrollTop();
      const $sb = $st + innerHeight;

      if ( el(a)[0] ) {
        if ( $st > cfg.a.timing ) {
          if ( !el(a).is('.-active') ) {
            el(a).addClass('-active');
          }
        } else {
          if ( el(a).is('.-active') ) {
            el(a).removeClass('-active');
            el(a).blur();
          }
        }
      }
    }

    addEventListener('scroll', callbak);
    addEventListener('load', callbak);
  }

  /**
   * click function
   */
  function click() {
    const $clickTarget = $('[data-click]');

    function action(e) {
      return $('[data-action="'+e+'"]');
    }

    function scrollTop(x, y) {
      let scTimer;

      if ( y >= 1 ) {
        const scTop = Math.floor( y - ( y / (7 * 2) ) );

        window.scrollTo(x, scTop);
        scTimer = setTimeout(function() {
          scrollTop(x, scTop);
        }, 7);
      } else {
        clearTimeout(scTimer);
        window.scrollTo(x, 0);
      }
    }

    $clickTarget.click(function() {
      const _this = $(this);
      const $clickName = _this.data('click');

      if ( $clickName === 'scrolToPageTop' ) {
        const x = BODY.scrollLeft || document.documentElement.scrollLeft;
        const y = BODY.scrollTop || document.documentElement.scrollTop;

        scrollTop(x, y);

        return false;
      }

      if ( 'toggleDisplay' === $clickName ) {
        _this.toggleClass('-active');
        _this.parent().find(action('toggleDisplay')).stop().slideToggle(200);
      }

      if ( 'resetVal' === $clickName ) {
        const target = _this.data('reset-target');

        if ( target ) {
          $('[name="'+target+'"]').val('').focus();
        }
      }

      if ( 'hamburgerMenu' === $clickName ) {
        $BODY.toggleClass('-opened_hamburgerMenu');
      }

      if ( -1 !== $clickName.indexOf('smoothScroll') ) {
        let position = '';

        const speed = 600;
        const href = $(this).attr("href");
        const target = $(href == "#" || href == "" ? 'html' : href);

        position = target.offset().top;

        $('body,html').animate({
          scrollTop: position
        }, speed, 'swing');

        return false;
      }
    });
  }

  /**
   * スマホの時、テーブルをスクロール可能にする
   */
  function contentTable() {
    if ( $('.wp_TheContent table')[0] ) {
      if ( detect() === 'MaxS' ) {
        $('.wp_TheContent table').each(function() {
          $(this).wrap('<div class="_ScrollTable"><div class="_ScrollTable__inner"><div class="_ScrollTable__content"></div></div></div>');
        });
      }
    }
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

  /**
   * bodyのクラス名から特定のクラスを判定
   *
   * @return {Strings}
   */
  function detect() {
    if ( innerWidth > 992 ) {
      return 'full';
    } else if ( innerWidth > 768 ) {
      return 'MaxL';
    } else if ( innerWidth > 575 ) {
      return 'MaxM';
    } else {
      return 'MaxS';
    }
  }
}(jQuery));
