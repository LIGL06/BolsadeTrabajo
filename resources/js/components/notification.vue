<template>
    <li class="nav-item dropleft">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <i
                    class="fa fa-globe"></i> <span class="badge badge-danger" id="count-notification">{{notifications.length}}<span
                class="caret"></span></span>
        </button>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-for="notification in notifications"
               v-on:click="MarkAsRead(notification)">
                <small>{{notification.data['message']}}</small>
            </a>
            <div class="dropdown-divider" v-if="notifications.length!=0"></div>
            <a href="#" class="dropdown-item"v-on:click="MarkAllNotifications()" v-if="notifications.length != 0">
                <small>Marcar todas como leídas</small>
            </a>
            <a href="#" class="dropdown-item" v-if="notifications.length == 0">
                <small>No hay notificaciones</small>
            </a>
        </div>
    </li>
</template>
<script>
    export default {
        props: ['notifications'],
        methods: {
            MarkAsRead: function (notification) {
                var data = {
                    not_id: notification.id,
                    notification_id: notification.data.id,
                };
                axios.post('markAsRead', data).then(response => {
                    window.location.href = 'home';
                });
            },
            MarkAllNotifications: function(){
                axios.post('markAllNotifications').then(response => {
                    window.location.href = 'home';
                })
            }
        }
    }

</script>
