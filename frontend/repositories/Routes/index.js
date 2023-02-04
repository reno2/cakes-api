const Index = {
  'http://2cake.nuxt/api/v1/profile/articles' : {
    url : '/profile/articles/',
    auth: true
  }
}

const getRute = (store, redirect, url) => {
  //redirect('/profile/articles/')
  console.log(url)
}

export default getRute;
