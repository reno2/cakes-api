import ModalBus from "@/helpers/ModalBus";

export default (ctx, inject) => {
  inject('modalBus', ModalBus)
}
