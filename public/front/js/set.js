// スムーズスクロール

$(function () {
  $('a[href^="#"]').click(function () {
    var speed = 500;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position }, speed, "swing");
    return false;
  });
});

$(function () {
  $("form").submit(function () {
    if ($("#agreement").prop("checked") == false) {
      $('.agreementformError').show();
      return false;
    } else {
      $('.agreementformError').hide();
      return true;
    }
  });
});

// validate
$(document).ready(function () {
  $("#form").validationEngine("attach", {
    promptPosition: "bottomLeft", //アラートの吹き出しを左下に設定
  });
});
