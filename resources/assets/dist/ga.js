function initVideoScroll() {
    $(window).scroll(function() {
        null !== $("#video").data("ytPlayer") && ($(this).scrollTop() > $(window).height() ? 1 == $("#video").data("ytPlayer").player.getPlayerState() && ($("#video").data("ytPlayer").player.pauseVideo(), $(".hero-scroll").hide(), $("#video").fadeOut()) : 2 == $("#video").data("ytPlayer").player.getPlayerState() && ($("#video").data("ytPlayer").player.playVideo(), $("#video").fadeIn(), $(".hero-scroll").show()))
    })
}

function checkHS() {
    var e = "https://app.hubspot.com/nav/jsonp?fallbackViewName=public_signed_out&mode=MOST_RECENT&fallbackViewLang=en&callback=?";
    $.getJSON(e, function(e) {
        e.indexOf("Hub ID:") > -1 && $("#product").length && ($("#features-list").prepend('<div class="hubspot-crm-webinar-registration" style="width:100%;background:#ffffff;"></div><hr>'), $(".hubspot-crm-webinar-registration").load("integrations/hubspot-crm-webinar.html", function() {
            $.getScript("assets/js/webinar.js", function() {
                $(".countdown-box h3").html('eSignatures for <span class="highlight">HubSpot CRM</span> next webinar session:'), setTimeout(initWebinar, 1e3)
            })
        }))
    })
}

function getQSVariable(e) {
    for (var t = window.location.search.substring(1), a = t.split("&"), n = 0; n < a.length; n++) {
        var i = a[n].split("=");
        if (decodeURIComponent(i[0]) == e) return decodeURIComponent(i[1])
    }
}
var ga_uaid = "UA-61577386-1",
    ga_autolink = ["getaccept.se", "blog.getaccept.com", "app.getaccept.com"],
    leadin_id = "2174309",
    leadin_exclude = ["/signup.html", "/event-hospitality.html", "/bookdemo.html", "/buy.html"],
    username = "whatsup";
$("document").ready(function() {
    if ($(this).scrollTop() > $(window).height() ? $("#video").hide() : $("#video").show(), jQuery.scrollDepth({
            minHeight: 2e3,
            elements: ["#hero", "#product", "#features", "#price", "#team", "#contacts"],
            percentage: !1,
            userTiming: !0,
            pixelDepth: !1,
            nonInteraction: !1
        }), $(window).width() > 480 && -1 == $.inArray(document.location.pathname, leadin_exclude)) {
        $.getScript("//js.leadin.com/js/v1/" + leadin_id + ".js", function(e, t, a) {});
        var e = 0,
            t = setInterval(function() {
                e++, $(".leadin-content-body").length ? (clearInterval(t), $(".leadin-content-body p").html($(".leadin-content-body p").html().replace(" --", '</p><p style="font-size:0.7em;margin-left:0;">')), $("#sign-up").length && $(".leadin-advance-button").on("click", function() {
                    $(".leadin-content-body p").html($(".leadin-content-body p").html().replace(" --", '</p><p style="font-size:0.8em;margin-left:0;margin-top:20px;">')), $("form.leadin-form-wrapper").on("submit", function(e) {
                        $(e.target).find(".input-email").is(".input-error") === !1 && ($("#sign-up").find(".email").val($(e.target).find(".input-email").val()), $("#sign-up").submit(), $("a.leadin-footer-link").remove())
                    })
                })) : e > 20 && clearInterval(t)
            }, 500)
    }
    var a = !1;
    $(window).width() > 480 && $("#video").length ? (setTimeout(function() {
        $.getScript("assets/js/jquery.youtubebackground.js", function(e, t, n) {
            $("#video").YTPlayer({
                fitToBackground: !0,
                videoId: "KtPdHg9sWzg",
                callback: function() {
                    /*$("#video").data("ytPlayer").player.addEventListener("onStateChange", function(e) {
                        a === !1 && (a = !0, $(".ytplayer-player").fadeIn(2500), $(this).scrollTop() > $(window).height() && $("#video").data("ytPlayer").player.pauseVideo(), initVideoScroll())
                    })*/
                }
            })
        })
    }, 100), setTimeout(function() {
        $(".sign-animation").prop("src", "assets/img/features/sign-animation.gif"), $(".iphone-animation").prop("src", "assets/img/features/iphone_push3.gif")
    }, 2e3)) : $(".hero-scroll").hide();
    var n = "info",
        i = "gotmanaged.com",
        s = n + "@" + i;
    if ($("#info-mail").attr("href", "mailto:" + n + "@" + i), $("#info-mail").html(s), $("#signup-name").on("change", function() {
            var e = $("#signup-name").val();
            e = e.split(" "), $("#mce-FNAME").val(e[0]), e.length > 1 && $("#mce-LNAME").val(e[1])
        }), setTimeout(checkHS, 5e3), toastr.options = {
            positionClass: "toast-top-full-width"
        }, $("#sign-up").length) {
        $("#sign-up").validate({
            rules: {
                "user-email": {
                    required: !0,
                    email: !0
                }
            },
            messages: {
                "user-email": {
                    required: "Please fill out an email address.",
                    email: "This is not a valid email address"
                }
            },
            submitHandler: function(e) {
                $("#sign-up input.button").prop("disabled", "disabled"), $("#sign-up #mce-error-response").hide(), $("#sign-up #mce-success-response").html('<span class="notice_message">Verifying your email address...</span>').show(), $.ajax({
                    type: "GET",
                    url: "https://app.getaccept.com/profile",
                    callback: "?",
                    dataType: "jsonp",
                    data: $(e).serialize(),
                    success: function(e) {
                        1 == e.status ? ($(".text-heading .success-top-logo").fadeIn(), $(".text-heading h1").text("Welcome to GetAccept!"), e.registration_url && $(window).width() > 750 ? $(".text-heading p.first").text("Your account is getting prepared and you should be redirected in a few seconds.") : $(".text-heading p.first").text("Almost there! Please check your inbox and confirm your account by clicking the button in the email."), $(".text-heading p.second").text(""), $(".hideonsuccess").hide(), ga("send", "event", "Forms", "Sign-up"), fbq("track", "CompleteRegistration"), window.optimizely = window.optimizely || [], window.optimizely.push(["trackEvent", "Sign-up"]), Intercom("update", {
                            registration_email: $("#sign-up").find(".email").val()
                        }), e.registration_url && $(window).width() > 750 && setTimeout(function() {
                            document.location = e.registration_url
                        }, 3e3)) : 2 == e.status ? ($("#sign-up #mce-success-response").hide(), $("#sign-up #mce-error-response").html('<span class="success_message">You already have an account, please go to <a href="https://app.getaccept.com">the login page</a>.</span>').show()) : 3 == e.status ? ($("#sign-up #mce-success-response").hide(), $("#sign-up #mce-error-response").html('<span class="success_message">Invalid formatted email. ' + (e.did_you_mean ? "Did you mean " + e.did_you_mean + "?" : "") + "</span>").show()) : 4 == e.status ? ($("#sign-up #mce-success-response").hide(), $("#sign-up #mce-error-response").html('<span class="success_message">Email looks wrong. ' + (e.did_you_mean ? "Did you mean " + e.did_you_mean + "?" : "") + "</span>").show()) : ($("#sign-up #mce-success-response").hide(), $("#sign-up #mce-error-response").html('<span class="error_message">Private or anonymous email addresses can not be used.</span>').show()), $("#sign-up input.button").removeAttr("disabled")
                    },
                    error: function(e, t, a) {
                        console.log(t), console.log(a), $("#sign-up input.button").removeAttr("disabled")
                    }
                })
            }
        });
        var o = [];
        if (document.cookie) {
            var r = (/(?:^|; )__utmz=([^;]*)/.exec(document.cookie) || []).slice(1).pop();
            if (r) {
                r = r.split(".").slice(4).join(".").split("|");
                for (var c = {}, l = 0; l < r.length; l++) {
                    var d = r[l].split("=");
                    c[d[0]] = d[1]
                }(c.utmgclid || c.utmcsr) && (o.push(c.utmgclid ? "google" : c.utmcsr), o.push(c.utmgclid ? "cpc" : c.utmcmd), o.push(c.utmccn))
            }
        }
        window.location.search && (getQSVariable("ref") && o.push(getQSVariable("ref")), getQSVariable("campaign") && o.push(getQSVariable("campaign")), getQSVariable("utm_term") && o.push("ut:" + getQSVariable("utm_term")), getQSVariable("utm_campaign") && o.push("uc:" + getQSVariable("utm_campaign"))), o.length > 0 && $("#sign-up input#user-registration-campaign").val(o.join("|"))
    }
    $("#subscribe").length && $("#subscribe").validate({
        messages: {
            email: "Please enter a valid email address"
        },
        submitHandler: function(e) {
            $("#subscribe .response").html('<span class="notice_message">Adding email address...</span>'), ga("send", "event", "Forms", "Subscribe"), $.ajax({
                url: "assets/mailchimp/inc/store-address.php",
                data: "ajax=true&action=subscribe&email=" + escape($("#NewsletterEmail").val()),
                success: function(e) {
                    -1 != e.indexOf("Success") ? $("#subscribe .response").html('<span class="success_message">Success! You are now subscribed to our newsletter!</span>') : $("#subscribe .response").html('<span class="error_message">' + e + "</span>"), Intercom("update", {
                        newsletter_email: $("#NewsletterEmail").val()
                    })
                },
                error: function(e, t, a) {
                    console.log(t), console.log(a)
                }
            })
        }
    }), $(".pay-switch").length && $(".pay-switch div").on("click", function() {
        $(".pay-switch div").removeClass("selected"), $(this).addClass("selected"), $(".package-price.monthly,.package-price.annually").addClass("hidden"), $(this).is(".monthly") ? $(".package-price.monthly").removeClass("hidden") : $(".package-price.annually").removeClass("hidden")
    })
}),
    function(e, t, a, n) {
        if (!e.getElementById(a)) {
            var i = e.createElement(t),
                s = e.getElementsByTagName(t)[0];
            i.id = a, i.src = "//js.hs-analytics.net/analytics/" + Math.ceil(new Date / n) * n + "/541808.js", s.parentNode.insertBefore(i, s)
        }
    }(document, "script", "hs-analytics", 3e5),
    function(e, t, a, n, i, s, o) {
        e.GoogleAnalyticsObject = i, e[i] = e[i] || function() {
                (e[i].q = e[i].q || []).push(arguments)
            }, e[i].l = 1 * new Date, s = t.createElement(a), o = t.getElementsByTagName(a)[0], s.async = 1, s.src = n, o.parentNode.insertBefore(s, o)
    }(window, document, "script", "https://www.google-analytics.com/analytics.js", "ga"), ga("create", ga_uaid, "auto", {
    allowLinker: !0
}), ga("require", "linker"), ga("linker:autoLink", ga_autolink), ga("send", "pageview"), ! function(e, t, a, n, i, s, o) {
    e.fbq || (i = e.fbq = function() {
        i.callMethod ? i.callMethod.apply(i, arguments) : i.queue.push(arguments)
    }, e._fbq || (e._fbq = i), i.push = i, i.loaded = !0, i.version = "2.0", i.queue = [], s = t.createElement(a), s.async = !0, s.src = n, o = t.getElementsByTagName(a)[0], o.parentNode.insertBefore(s, o))
}(window, document, "script", "https://connect.facebook.net/en_US/fbevents.js"), fbq("init", "1701184443433338"), fbq("track", "PageView");
var google_conversion_id = 952253662,
    google_conversion_label = "ql8oCPn4zmMQ3vmIxgM",
    google_custom_params = window.google_tag_params,
    google_remarketing_only = !0;
document.write('<script src="//www.googleadservices.com/pagead/conversion.js"></script>'), window.innerWidth > 500 && (window.intercomSettings = {
    app_id: "g2tc8sjs"
}),
    function() {
        function e() {
            var e = n.createElement("script");
            e.type = "text/javascript", e.async = !0, e.src = "https://widget.intercom.io/widget/g2tc8sjs";
            var t = n.getElementsByTagName("script")[0];
            t.parentNode.insertBefore(e, t)
        }
        var t = window,
            a = t.Intercom;
        if ("function" == typeof a) a("reattach_activator"), a("update", intercomSettings);
        else {
            var n = document,
                i = function() {
                    i.c(arguments)
                };
            i.q = [], i.c = function(e) {
                i.q.push(e)
            }, t.Intercom = i, t.attachEvent ? t.attachEvent("onload", e) : t.addEventListener("load", e, !1)
        }
    }();

//# sourceMappingURL=ga.js.map