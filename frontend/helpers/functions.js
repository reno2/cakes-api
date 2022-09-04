export default function makePath(type, slug) {
  let path = null
  switch (type) {
    case 'category' :
      path = `/${type}/${slug}`;
      break;
  }
  return path
}
