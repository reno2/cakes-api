const Sections = class {

  sections(components, sortArray = null) {

    if (!Array.isArray(components)) {
      return [];
    }

    const adaptedComponents = components.map((component) => {

      switch (component.type) {
        case 'banner':
          return this.sectionBanner(component);
        case 'ads-front':
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
      list = []
    } = component || {};

    return {
      tags,
      type,
      title,
      list
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
