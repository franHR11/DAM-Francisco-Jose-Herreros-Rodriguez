<script setup>
import Header from './components/Header.vue'
</script>

<template>
<div class="my-20 max-w-lg mx-auto bg-white shadow p-10">
    <Header />

    <div class="my-5">
       <input
        type="range"
        class="w-full bg-gray-200 accent-lime-500 hover:accent-lime-600"
       />
    </div>

</div>
</template>
