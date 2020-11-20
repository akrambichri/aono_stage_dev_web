import Vue from 'vue'
import Router from 'vue-router'

import WelcomePage from '@/views/WelcomePage'
import EquipeListe from '@/components/Equipe/EquipeListe'
import FormEquipe from '@/components/Equipe/FormEquipe'
import MatchListe from '@/components/Match/MatchListe'
import FormMatch from '@/components/Match/FormMatch'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'WelcomePage',
      component: WelcomePage
    },
    {
      path: '/EquipeListe',
      name: 'EquipeListe',
      component: EquipeListe,
      props: true
    },
    {
      path: '/FormEquipe',
      name: 'FormEquipe',
      component: FormEquipe,
      props: true
    },
    {
      path: '/MatchListe',
      name: 'MatchListe',
      component: MatchListe,
      props: true
    },    
    {
      path: '/FormMatch',
      name: 'FormMatch',
      component: FormMatch,
      props: true

    },
  ]
})