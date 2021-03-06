<template>
  <div id="Navrbar">
    <!-- Logo -->
		<img class="logo" src="../assets/logo.png" width="60" >
    <!-- Nav Links -->
    <nav class="navMenu" :style="[userStyles.navMenu, menuDirection, menuWidth]">
      <a href="javscript:void(0)" class="closebtn" @click.prevent="closeMenu"><i class="arrow left icon" style="font-size:24px;"></i></a>
      <template v-if="links.length">
        <router-link class="spacing" v-for="link in links" v-bind:key="link.id" :to="`${link.page}`" :style="link.styles">
            <p>-----------------------</p> <a :key="link.id" :href="link.page" :style="link.styles">{{ link.text }}</a>
        </router-link>
      </template>
      <slot v-else />
    </nav>
    <!-- Hamburger Menu -->
    <nav class="navIcon" :style="[userStyles.navIcon, iconDirection]">
      <a href="javscript:void(0)" @click.prevent="toggleMenu" data-test-ref="navMenuLink">
        <svg width="30" height="30">
          <path d="M0,5 30,5" :stroke="styles['menu-icon-color']" stroke-width="5"/>
          <path d="M0,14 30,14" :stroke="styles['menu-icon-color']" stroke-width="5"/>
          <path d="M0,23 30,23" :stroke="styles['menu-icon-color']" stroke-width="5"/>
        </svg>
      </a>
    </nav>
  </div>
</template>

<script>
import styles from '@/assets/sass/variables.scss'
export default {
  name: 'mymenu',
  props: {
    width: {
      type: Number,
      required: false,
      default: 250
    },
    format: {
      type: String,
      required: false,
      default: 'overlay',
      validator: (value) => ['push', 'full', 'overlay'].indexOf(value) > -1
    },
    direction: {
      type: String,
      required: false,
      default: 'left',
      validator: (value) => ['left', 'right'].indexOf(value) > -1
    },
    opacity: {
      type: Number,
      required: false,
      default: 0
    },
    links: {
      type: Array,
      required: false,
      default: () => ([])
    },
    customStyles: {
      type: Object,
      required: false,
      deep: true,
      default: () => ({})
    }
  },
  data () {
    const defaultStyles = {
      'navMenu': {},
      'navIcon': {}
    }
    return {
      styles: styles,
      menuWidth: {
        'width': 0
      },
      userStyles: Object.assign({}, defaultStyles, this.customStyles)
    }
  },
  watch: {
    customStyles () {
      this.userStyles = Object.assign({}, this.userStyles, this.customStyles)
    }
  },
  computed: {
    menuDirection () {
      return this.direction === 'right'
        ? { 'right': 0 }
        : { 'left': 0 }
    },
    iconDirection () {
      return { 'float': this.direction }
    },
    app () {
      return document.getElementById('app')
    }
  },
  mounted () {
    if (!this.app) {
      console.warn(`[Menu] The format was set to '${this.format}', but there is no element with an id 'app'. Add id='app' to the element to move.`)
    }
  },
  methods: {
    openMenu () {
      const width = `${this.width}px`
      const marginDirection = `margin-${this.direction}`
      this.menuWidth = {
        'width': this.format === 'full' ? '100%' : width
      }
      const defaultStyles = {
        'navMenu': {opacity:100},
        'navIcon': {opacity:0}
      }
      if (this.app && this.format === 'push') {
        this.app.style[marginDirection] = width
        this.app.style.transition = `${marginDirection} .5s`
        this.userStyles = Object.assign({},this.userStyles, defaultStyles)
      }
    },
    closeMenu () {
      
      this.menuWidth = { 'width': 0 }
      const defaultStyles = {
        'navMenu': {opacity:0},
        'navIcon': {opacity:100}
      }
      if (this.app) {
        this.app.style.marginLeft = '0'
        this.app.style.marginRight = '0'
        this.userStyles = Object.assign({},this.userStyles, defaultStyles)

      }
      if (this.opacity) {
        document.body.style.background = styles['background']
      }
    },
    toggleMenu () {
      if (this.menuWidth.width === 0) {
        this.openMenu()
      } else {
        this.closeMenu()
      }
    }
  }
}
</script>