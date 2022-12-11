const Seo = class {
  // seoArticle(sections) {
  //   const findArticle = sections.find(
  //     (section) => section._field === 'article'
  //   );
  //   const { title = '', cover = {}, seo = {} } = findArticle || {};
  //   const articleImage = this.seoImage(cover);
  //   const adaptedSeo = this.seoPage(seo);
  //   if (!adaptedSeo.title) {
  //     adaptedSeo.title = title;
  //   }
  //   if (!adaptedSeo.image && !!articleImage) {
  //     adaptedSeo.image = articleImage;
  //   }
  //   return adaptedSeo;
  // }
  //
  // seoImage(image) {
  //   const { path = null, source = null } = image || {};
  //   if (path || source) {
  //     if (process.env.IMAGE_OPTIMIZE_METHOD === 'rewrite') {
  //       return `${rootUrl}/1200-630-80/thumbnail/${(path || source).replace(
  //         '/storage/uploads/',
  //         ''
  //       )}`;
  //     } else {
  //       return `${rootUrl}?src=${path || source}&w=1200&h=630&q=80`;
  //     }
  //   }
  //   return '';
  // }

  seoPage(seo) {
    const { title = null, image = {}, description = null } =
    seo || {};
    return {
      title,
      description,
    };
  }
};

export default new Seo();
