$(function () {
  $(".checkbox-valid").css("display", "none");

  $(".modal_open").on("click", function () {
    $cont = $(this).data("modal");
    $(".modal_bg," + $cont).addClass("active");
  });

  // $(".modal_cont .close,.modal_bg").on("click", function () {
  //   $(".modal_bg,.modal_cont").removeClass("active");
  // });
  // $(".modal_cont").on("click", function (e) {
  //   e.stopPropagation();
  // });
  $("#panel_btn").on("click", function () {
    $(this).toggleClass("active");
  });

  $(".sp_menu a").on("click", function () {
    $("#panel_btn").removeClass("active");
  });

  $(".movie_tmn").on("click", function () {
    $("#modal_bg").addClass("active");
    player.playVideo();
  });
  $("#modal_bg .close_btn").on("click", function () {
    $("#modal_bg").removeClass("active");
    player.pauseVideo();
  });
  $("#modal_bg").on("click", function () {
    $("#modal_bg").removeClass("active");
  });
  $(".movie_cont").on("click", (event) => {
    event.stopPropagation();
  });

  $("#docform a.back_btn").on("click", function () {
    $("#docform").attr("action", "index.php#application");
    $("#docform").submit();
  });

  $("#docform .btn_submit").on("click", function () {
    $err = false;
    $(".err,.err_email").remove();

    if ($("#agreement").is(":checked")) {
      $(".checkbox-valid").css("display", "none");
    } else {
      $(".checkbox-valid").css("display", "inline-block");
      $err = true;
    }

    $(".chk").each(function () {
      if ($(this).attr("type") == "email" && !MailCheck($(this).val())) {
        $err = true;
        $(this).after(
          '<span class="err_email">メールアドレスの書式が不正です。</span>'
        );
      } else if ($(this).val() == "") {
        $err = true;
        $(this).after('<span class="err">必須入力項目です。</span>');
      } else {
      }
    });

    $(".chk_checkbox").each(function () {
      if (checkBoxCheck($(this))) {
      } else {
        $err = true;
        $(this).before('<span class="err abs">必須確認項目です。</span>');
      }
    });

    if (!$err) {
      $("#docform").submit();
    } else {
      $("html,body").animate({ scrollTop: $("#docform").offset().top });
    }
  });

  $('a[href*="#"], area[href*="#"]')
    .not(".noScroll")
    .click(function () {
      (href = $(this).prop("href")),
        (hrefPageUrl = href.split("#")[0]),
        (currentUrl = location.href),
        (currentUrl = currentUrl.split("#")[0]);
      if (hrefPageUrl == currentUrl) {
        href = "#" + href.split("#").pop();
        if (href != "#" && $(href).length > 0) {
          position = $(href).offset().top;
          $("body,html").animate({ scrollTop: position }, 400, "swing");
        }
        return false;
      }
    });
});

$(window).on("load scroll resize", function () {
  var s = $(window).scrollTop();
  var h = $(window).innerHeight();
  var ha = $(window).innerHeight() * 0.8;
  var ap = $("#application").offset().top;

  if (s > ap) {
    $(".fixed_menu").removeClass("active");
  } else if (s > 700) {
    $(".fixed_menu").addClass("active");
  } else {
    $(".fixed_menu").removeClass("active");
  }

  $(".anime").each(function () {
    if ($(this).offset().top < s + ha) {
      $(this).addClass("active");
    } else {
      $(this).removeClass("active");
    }
  });
});

$(window).on("load resize", function () {
  wsize = $(window).width();
  if (wsize <= 640) {
    $("img").each(function () {
      $(this).attr("src", $(this).attr("src").replace("_pc.", "_sp."));
    });
    $("#main table tbody td").each(function () {
      if ($(this).data("title")) {
        $(this).before('<th class="sp">' + $(this).data("title") + "</th>");
      }
    });
  } else {
    $("img").each(function () {
      $(this).attr("src", $(this).attr("src").replace("_sp.", "_pc."));
    });
    $("#main table tbody th.sp").remove();
  }
});

function checkBoxCheck(checkbox) {
  var count = checkbox.find("input[type=checkbox]:checked").length;
  if (count > 0) {
    return true;
  } else {
    return false;
  }
}

function MailCheck(mail) {
  var mail_regex1 = new RegExp(
    "(?:[-!#-'*+/-9=?A-Z^-~]+.?(?:.[-!#-'*+/-9=?A-Z^-~]+)*|\"(?:[!#-[]-~]|\\\\[\x09 -~])*\")@[-!#-'*+/-9=?A-Z^-~]+(?:.[-!#-'*+/-9=?A-Z^-~]+)*"
  );
  var mail_regex2 = new RegExp("^[^@]+@[^@]+$");
  if (mail.match(mail_regex1) && mail.match(mail_regex2)) {
    if (
      mail.match(
        /[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/
      )
    ) {
      return false;
    }
    if (!mail.match(/\.[a-z]+$/)) {
      return false;
    }
    return true;
  } else {
    return false;
  }
}
