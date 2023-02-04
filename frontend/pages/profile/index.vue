<template>
  <div>
    {{this.$auth.user.name}}
    <button @click="sendEvent">Проверка события</button>
  </div>

</template>

<script>
import Echo from "laravel-echo"
import socketio from 'socket.io';
export default {
  middleware: 'verified',
  layout: 'profile',
  data() {
    return {
      user: null
    }
  },
  methods:{
    async sendEvent(){

      try{
        const response = await this.$axios.$get('event_two', { params: {user : 2}});
        //const response = await this.$axios.$get('event_two', { params: {user : this.$auth.user.id}});
        //console.log(response)
      }catch (e) {
        console.log(e)
      }


    }
  },
   mounted() {
     const echo = this.$echo.test()
     const userId = this.$auth.user.id
     echo.join(`user.${userId}`)
       .listen('.channel', (e) => {
         this.$notify.success({
           title: 'Hooray',
           message: e.data.name
         })

         console.log(e)
       })

     // window.Echo = new Echo({
     //   broadcaster: 'socket.io',
     //   host: window.location.hostname + ':6001',
     //   // transports: ['websocket', 'polling', 'flashsocket']
     // });
     // console.log(Echo)
  },
  name: 'Profile',
  // async asyncData({$axios}) {
  //
  //
  //   const posts = await $axios.$get('/posts');
  //   console.log(posts)
  //   return { posts }
  //
  // }
}
</script>
