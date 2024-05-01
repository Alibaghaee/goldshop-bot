<template>
<div class="w-full">
    <tree :data="items" draggable="draggable" cross-tree="cross-tree" @change="treeChange" @drag="ondrag">
      <div slot-scope="{data, store}">
        <div v-if="!data.isDragPlaceHolder">
          <span class="align-text-top ml-2 text-blue" v-if="data.children && data.children.length" @click="store.toggleOpen(data)">
            <svg v-if="data.open" class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 64">
              <path d="M0 0h384v64H0z"/>
            </svg>
            <svg v-else class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384">
              <path d="M384 160H224V0h-64v160H0v64h160v160h64V224h160z"/>
            </svg>
          </span>
          <slot name="item" :item="data" :store="store"></slot>
        </div>
      </div>
    </tree>
    <button type="button" class="mt-4 float-left rhc-btn rhc-btn-teal" @click="onSubmit">تایید</button>
</div>
</template>

<script>
import {DraggableTree} from 'vue-draggable-nested-tree'
import * as th from 'tree-helper'
import { Form, FormErrors } from './../../../form.js';

export default {
  components: {Tree: DraggableTree},
  props: {
      'items': {
          required: true
      },
      'endpoint_uri': {
          required: true,
          default: 'Add some content using Markdown ...'
      },
      'max_level': {
          default: 1
      }
  },
  data() {
    return {
      data: {},
      endpoint: this.endpoint_uri,
      method: 'post',
      form: new Form(this.form_data),
      maxLevel: this.max_level,
    }
  },
  methods: {
    treeChange(node, targetTree) {
      this.data = targetTree.getPureData()
    },
    onSubmit (){
      this.form = new Form({'items_data' : this.data});
      this.form[this.method](this.endpoint);
    },
    ondrag(node) {
      const {maxLevel} = this
      let nodeLevels = 1
      th.depthFirstSearch(node, (childNode) => {
        if (childNode._vm.level > nodeLevels) {
          nodeLevels = childNode._vm.level
        }
      })
      nodeLevels = nodeLevels - node._vm.level + 1
      const childNodeMaxLevel = maxLevel - nodeLevels
      //
      th.depthFirstSearch(this.items, (childNode) => {
        if (childNode === node) {
          return 'skip children'
        }
        if (!childNode._vm) {
          console.log(childNode);
        }
        this.$set(childNode, 'droppable', childNode._vm.level <= childNodeMaxLevel)
      })
    },
  },
}
</script>

<style>
</style>