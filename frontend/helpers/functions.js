export  const makePath = (type, slug) =>  {
  let path = null
  switch (type) {
    case 'category' :
    case 'ads' :
      path = `/${type}/${slug}`;
      break;
  }
  return path
}

export const checkRequired = val => !!val

