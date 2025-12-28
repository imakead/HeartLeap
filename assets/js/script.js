
jQuery(function() {
  jQuery('.accordion-header').click(function() { // .accordion-headerをクリックで発火
    jQuery(this).next().slideToggle();
    // $(this)...$('.accordion-header')の.next()...次の要素が.slideToggle()...表示と非表示を交互にする
    jQuery(this).toggleClass('active');
    // $(this)...$('.accordion-header')に、activeというクラスが追加と削除を交互にする
  });
  
})

//PageTopボタン　すぅっと現れる
jQuery(function() {
  var pagetop = $('#page_top');   
  pagetop.hide();
  $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {  //100pxスクロールしたら表示
          pagetop.fadeIn();
      } else {
          pagetop.fadeOut();
      }
  });
  pagetop.click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 500); //0.5秒かけてトップへ移動
      return false;
  });
});
