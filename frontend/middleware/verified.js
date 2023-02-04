export default function ({redirect, store, req }) {
  const verified = store.state.auth.user && store.state.auth.user.email_verified_at

  if (!verified) {
    redirect('/email/verify')
  }

}
