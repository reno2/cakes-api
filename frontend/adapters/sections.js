const Sections = class {

  sections(components, sortArray = null) {

    if (!Array.isArray(components)) {
      return [];
    }

    const adaptedComponents = components.map((component) => {
      // console.log(1, component)
      switch (component.type) {
        case 'banner':
          return this.sectionBanner(component);
        case 'ads-front':
        case 'profile-ads-list':
          return this.sectionCardsList(component);
        default:
          return component;
      }
    })


    if(sortArray) {
      adaptedComponents.sort((a, b) =>
         sortArray.indexOf(a.type) - sortArray.indexOf(b.type)
      );
    }


    return adaptedComponents
  }


  sectionCardsList(component) {
    const {
      title = '',
      tags = [],
      type = 'list_ads',
      data = [],
      links = {},
      meta = {},
      sections = []
    } = component || {};

    return {
      tags,
      type,
      title,
      data,
      links,
      meta,
      sections
    };
  }

  sectionBanner(component) {
    const {
      type = 'banner',
      list = []

    } = component || {};


    return {
      type,
      list
    };


  }
}

export default new Sections();
