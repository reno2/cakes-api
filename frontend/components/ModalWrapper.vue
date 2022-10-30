<script>
import ModalBus from "@/helpers/ModalBus";
import HtmlBlock from "@/components/HtmlBlock";
// import Reveal from "@/components/Reveal";
export default {
  data() {
    return {
      component: null,
      title: "",
      props: null,
      closeOnClick: true,
      html: "",
      modal: null,
      hidden: null
    };
  },
  created() {
    ModalBus.$on("close", () => {
      this.modal = null;
    });
    ModalBus.$on("open.component", ({ component, hidden = null}) => {
      this.hidden = hidden
      if (typeof component === "object") {
        this.component = component;
        this.modal = "component";
      } else {
        this.dynamicLoad(component);
      }
      this.modal = "component";
    });

    ModalBus.$on("open.html", ({ html, title = "" }) => {
      this.modal = "html";
      this.html = html;
      this.title = title;
    });
  },
  render(h) {
    if (!this.modal) return null;

    let component;
    if (this.modal === "html") {
      component = h("div", {
        domProps: {
          innerHTML: this.html
        }
      });
    } else {
      component = h(this.component, {
        props: {
          hidden: this.hidden
        }
      });
    }

    const modalData = h(
      HtmlBlock,
      {
        props: {
          title: this.title
        }
      },
      [component]
    );
    const transition = h(
      "div",
      {
        class: ["reveal_wrap"],
        on: { click: () => ModalBus.$emit("close") }
      },
      [modalData]
    );
    return h(
      "transition",
      {
        props: { mode: "out-in", name: "fade" }
      },
      [transition]
    );
  },
  methods: {
    async dynamicLoad(name) {
      try {
        const comp = await import(`@/components/${name}.vue`);
        this.component = comp.default;
      } catch (e) {}
    }
  }
};
</script>

<style>
.reveal_wrap {
  position: fixed;
  background: #00000085;
  height: 100vh;
  top: 0;
  display: flex;
  width: 100vw;
  left: 0;
  justify-content: center;
  align-items: center;
}
/*.slide-fade-enter-active {*/
/*  transition: all 0.3s ease;*/
/*}*/
/*.slide-fade-leave-active {*/
/*  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);*/
/*}*/
/*.slide-fade-enter, .slide-fade-leave-to*/
/*  !* .slide-fade-leave-active до версии 2.1.8 *! {*/
/*  transform: translateX(10px);*/
/*  opacity: 0;*/
/*}*/
</style>
