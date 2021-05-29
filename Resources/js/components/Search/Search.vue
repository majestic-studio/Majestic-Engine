<template>
  <suspense>
    <template #default>
      <SearchComponent></SearchComponent>
    </template>
    <template #fallback>
      <SearchComponentSkeleton></SearchComponentSkeleton>
    </template>
  </suspense>
</template>

<script>
import SearchComponent from "./SearchComponent";
import SearchComponentSkeleton from "./SearchComponentSkeleton";

export default {
  name: "Search",
  components: {
    SearchComponent,
    SearchComponentSkeleton
  }
}
</script>

<style scoped>

</style>