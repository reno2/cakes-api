export default function ({redirect, store, req }) {
  const isAuth = store.state.auth.user && store.state.auth.user.email_verified_at
  console.log(isAuth)
  if(!isAuth){
    redirect('/login')
  }
  //const heedle = store.state.auth.user.roles.filter(role => role.name === 'User')
  //console.log(heedle)
  //console.log(store.state.auth.user.roles)
  // if(process.client) {
  //   console.log(1, isAuth)
  //   //redirect('/login')
  // }
  // if(process.server){
  //   console.log(2, isAuth)
  //   //redirect('/login')
  // }
  // // Add the userAgent property to the context
  // context.userAgent = process.server
  //   ? context.req.headers['user-agent']
  //   : navigator.userAgent
}
