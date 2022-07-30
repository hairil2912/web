var socket = io.connect("http://" + window.location.hostname + ":3000");

if (Notification.permission !== "granted") {
	Notification.requestPermission();
}

function emitNewMessage(message, sender_id, recipent_id) {
	socket.emit("new_message", {
		message: message,
		date: new Date(),
		sender_id: sender_id,
		recipent_id: recipent_id
	});
}

function emitNewNotification(
	sender_module,
	target_module,
	title,
	body,
	url,
	option = {}
) {
	socket.emit("new_notification", {
		sender_module: sender_module,
		target_module: target_module,
		title: title,
		body: body,
		url: url,
		option: option
	});
}

function playSound() {
	var media = document.getElementById("chatAudio");
	var playPromise = media.play();
	if (playPromise !== null) {
		playPromise.catch(() => {
			media.play();
		});
	}
}

async function showNotification(data) {
	if (Notification) {
		if (Notification.permission !== "granted") {
			await Notification.requestPermission();
		} else {
			var icon = "";
			switch (data.sender_module) {
				case "07":
					icon = site_url + "assets/images/icon/igd.png";
					break;
				case "08":
					icon = site_url + "assets/images/icon/receptionist.png";
					break;
				case "09":
					icon = site_url + "assets/images/icon/inap.png";
					break;
				case "10":
					icon = site_url + "assets/images/icon/claim.png";
					break;
				case "11":
					icon = site_url + "assets/images/icon/laboratorium.png";
					break;
				case "12":
					icon = site_url + "assets/images/icon/report.png";
					break;
				case "13":
					icon = site_url + "assets/images/icon/medicalrecord.png";
					break;
				case "14":
					icon = site_url + "assets/images/icon/radiologi.png";
					break;
				case "15":
					icon = site_url + "assets/images/icon/utd.png";
					break;
				case "16":
					icon = site_url + "assets/images/icon/administrator.png";
					break;
				case "17":
					icon = site_url + "assets/images/icon/operasi.png";
					break;
				default:
					icon =
						"https://png.pngtree.com/png-vector/20190505/ourmid/pngtree-vector-bell-icon-png-image_1022585.jpg";
			}
			var notifikasi = new Notification(data.title, {
				icon: icon,
				body: data.body.replace(/<[^>]*>?/gm, "")
			});
			notifikasi.onclick = function() {
				window.open(data.url);
				notifikasi.close();
			};
		}
	}
}

socket.on("new_notification", function(data) {
	if (data.target_module == module) {
		if (data.option.id_ruangan) {
			if (data.option.id_ruangan == ruangan) {
				showNotification(data);
				$(".notification-list").prepend(
					`
						<li>
							<a href="#" style="white-space: normal;">
								` +
						data.body +
						`
								<br><span style="font-size: 10px">12-12-2019</span>
							</a>
						</li>
					`
				);
				var notification_count = parseInt($(".notification-badge").text()) + 1;
				$(".notification-badge")
					.addClass("show")
					.removeClass("hide")
					.text(notification_count);
			}
		} else {
			showNotification(data);
			$(".notification-list").prepend(
				`
			<li>
				<a href="#" style="white-space: normal;">
					` +
					data.body +
					`
					<br><span style="font-size: 10px">12-12-2019</span>
				</a>
			</li>
		`
			);
			var notification_count = parseInt($(".notification-badge").text()) + 1;
			$(".notification-badge")
				.addClass("show")
				.removeClass("hide")
				.text(notification_count);
			//playSound();
		}
	}
});

if (segment2 != "chat") {
	function appendNewMessage(message, sender_id, recipent_id) {
		emitNewMessage(message, sender_id, recipent_id);
		$(".msg_container_base").append(
			`
        <div class="row msg_container base_sent">
            <div class="col-md-10 col-xs-10">
                <div class="messages msg_sent">
                    <p>` +
				message +
				`</p>
                    <time datetime="2009-11-13T20:00">` +
				tglIndo(new Date()) +
				`</time>
                </div>
            </div>
            <div class="col-md-2 col-xs-2 avatar">
                <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
            </div>
        </div>
      `
		);
		var target = $(".msg_container_base");
		target.animate(
			{
				scrollTop: target.prop("scrollHeight")
			},
			700
		);
	}

	function appendIncomingMessage(data) {
		$(".msg_container_base").append(
			`
                        <div class="row msg_container base_receive">
                          <div class="col-md-2 col-xs-2 avatar">
                              <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                          </div>
                          <div class="col-md-10 col-xs-10">
                              <div class="messages msg_receive">
                                  <p>` +
				data.message +
				`</p>
                                  <time datetime="2009-11-13T20:00">` +
				tglIndo(data.date) +
				`</time>
                              </div>
                          </div>
                        </div>
                      `
		);
		var target = $(".msg_container_base");
		target.animate(
			{
				scrollTop: target.prop("scrollHeight")
			},
			700
		);
	}

	$(document).ready(function() {
		$(document).on("click", ".panel-heading span.icon_minim", function(e) {
			var $this = $(this);
			if (!$this.hasClass("panel-collapsed")) {
				$this
					.parents(".panel")
					.find(".panel-body")
					.slideUp();
				$this.addClass("panel-collapsed");
				$this.removeClass("glyphicon-minus").addClass("glyphicon-plus");
			} else {
				$this
					.parents(".panel")
					.find(".panel-body")
					.slideDown();
				$this.removeClass("panel-collapsed");
				$this.removeClass("glyphicon-plus").addClass("glyphicon-minus");
			}
		});
		$(document).on("focus", ".panel-footer input.chat_input", function(e) {
			var $this = $(this);
			if ($("#minim_chat_window").hasClass("panel-collapsed")) {
				$this
					.parents(".panel")
					.find(".panel-body")
					.slideDown();
				$("#minim_chat_window").removeClass("panel-collapsed");
				$("#minim_chat_window")
					.removeClass("glyphicon-plus")
					.addClass("glyphicon-minus");
			}
		});

		$(document).on("click", ".icon_close", function(e) {
			//$(this).parent().parent().parent().parent().remove();
			$("#chat_window_1").hide();
		});

		$("#btn-input").on("keypress", function(e) {
			if (e.which == 13) {
				var message = $("#btn-input").val();
				var sender_id = $("input[name=sender_id]").val();
				var recipent_id = $("input[name=recipent_id]").val();
				appendNewMessage(message, sender_id, recipent_id);
				$("#btn-input").val("");
			}
		});
		$(".msg_send_btn").on("click", function() {
			var message = $("#btn-input").val();
			var sender_id = $("input[name=sender_id]").val();
			var recipent_id = $("input[name=recipent_id]").val();
			appendNewMessage(message, sender_id, recipent_id);
			$("#btn-input").val("");
		});

		socket.on("new_message", function(data) {
			var sender_id = $("input[name=sender_id]").val();
			if (data.recipent_id == sender_id) {
				$("input[name=recipent_id]").val(data.sender_id);
				$("#chat_window_1")
					.removeClass("hide")
					.show();
				playSound();
				appendIncomingMessage(data);
			}
		});
	});
}
