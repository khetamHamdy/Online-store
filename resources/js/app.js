
require('./bootstrap');
    var channel = Echo.private(`App.Models.User.${userID}`);
    channel.notification(function (data) {
        $('#count_order').text(JSON.stringify(data.count_orders))
        console.log(data);
        alert(JSON.stringify(data.title));

        $(document).toastr('success', {
            title: data.title,
            body: data.body,
            animation: true,
            autohide: true,
            delay: 2000
        });
    });

// window.Echo.private('Notifications.' + userId)
//     .notification(function (message) {
//         let c = Number($('#unread-count').text())
//         c++
//         $('#unread-count').text(c)

//         $('#n-list').prepend(`<a href="#" class="dropdown-item">
//             <i class="fas fa-envelope mr-2"></i>
//             ${message.title}
//             <span class="float-right text-muted text-sm">now</span>
//         </a>
//         <div class="dropdown-divider"></div>`);

//         $(document).Toasts('create', {
//             title: message.title,
//             body: message.body,
//             animation: true,
//             autohide: true,
//             delay: 2000
//         });

//     });
