<template>

    <div class="w-full md:flex md:items-center lg:w-1/2 px-2 mb-4">
      <div class="md:w-1/4">
        <label :for="labelName" class="block text-grey-dark md:text-right mb-1 md:mb-0">{{ title }}</label>
      </div>
      <div class="md:w-3/4">
        <slot></slot>
      </div>
    </div>

</template>

<script>
    export default {
        props: ['title', 'labelName']
    }
</script>