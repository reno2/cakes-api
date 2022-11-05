
export function slideDown({element, slideSpeed, easing, delay, visibleDisplayValue}) {
  return slide({
    element,
    slideSpeed,
    direction: 'down',
    easing,
    delay,
    visibleDisplayValue
  })
}


export function slideUp({element, slideSpeed, easing, delay}) {
  return slide({
    element,
    slideSpeed,
    direction: 'up',
    easing,
    delay
  })
}

export  function slideToggle({element, slideSpeed, easing, delay, visibleDisplayValue}) {
  return slide({
    element,
    slideSpeed,
    easing,
    delay,
    visibleDisplayValue
  })
}


function slide({
                 element,
                 slideSpeed,
                 direction,
                 easing,
                 delay = 0,
                 visibleDisplayValue = 'block'
               }) {
  const domSliderId = element.dataset.domSliderId || (Date.now() * Math.random()).toFixed(0)

  if (!element.dataset.domSliderId) {
    element.dataset.domSliderId = domSliderId
  }

  const computedStyle = window.getComputedStyle(element)
  const isDisplayNoneByDefault = computedStyle.getPropertyValue('display') === 'none'
  const slideDirection = direction || (isDisplayNoneByDefault || element.classList.contains('DOM-slider-hidden') ? 'down' : 'up')
  const speed = slideSpeed ? slideSpeed : (slideSpeed === 0) ? 0 : 300

  let boxSizing = computedStyle.getPropertyValue('box-sizing')
  let paddingTop = parseInt(computedStyle.getPropertyValue('padding-top').split('px')[0])
  let paddingBottom = parseInt(computedStyle.getPropertyValue('padding-bottom').split('px')[0])
  let contentHeight = Math.max(element.scrollHeight - paddingTop - paddingBottom, 0)

  if (boxSizing === 'border-box') {
    contentHeight = Math.max(element.scrollHeight, 0)
  }

  if (element.dataset.sliding) {
    return Promise.resolve(element)
  }

  if (slideDirection === 'down' && !isDisplayNoneByDefault && !element.classList.contains('DOM-slider-hidden')) {
    return Promise.resolve(element)
  }

  if (slideDirection === 'up' && element.classList.contains('DOM-slider-hidden')) {
    return Promise.resolve(element)
  }

  element.dataset.sliding = true
  element.setAttribute('aria-hidden', slideDirection === 'down' ? 'false' : 'true')

  if (slideDirection === 'down' && isDisplayNoneByDefault) {
    element.classList.add('DOM-slider-hidden')
    element.style.display = visibleDisplayValue
    contentHeight = element.scrollHeight
  }

  // a fixed height is required in order to animate the height
  element.style.height = `${contentHeight}px`
  element.style.transition = `all ${speed}ms ${easing || ''}`
  element.style.overflow = 'hidden'

  return new Promise(function (resolve) {
    setTimeout(function () {
      // begin the animation
      element.classList.toggle('DOM-slider-hidden')
      resolve()
    }, +delay > 20 ? +delay : 20)
  })
    .then(function () {
      return new Promise(function (resolve) {
        setTimeout(function () {
          element.style.removeProperty('height')
          element.style.removeProperty('transition')
          element.style.removeProperty('overflow')
          element.removeAttribute('data-sliding')

          resolve(element)
        }, speed)
      })
    })
}
