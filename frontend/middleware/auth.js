export default function ({redirect, store, req }) {
  const isAuth = store.state.auth.user

  if (!isAuth) {
    redirect('/login')
  }

}
