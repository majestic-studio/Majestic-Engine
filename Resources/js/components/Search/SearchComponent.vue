<template>
  <div class="search" itemtype="https://schema.org/WebSite">
    <meta itemprop="url" content="{BASE_URL}">
    <form action="" method="get" itemtype="https://schema.org/SearchAction" role="search" aria-label="Найти товар">
      <div class="body-search df">
        <div class="search-container df">
          <input type="text" id="header-search" itemprop="query-input" name="text" autocomplete="off" class="search_input" placeholder="Искать товары" autocapitalize="off" spellcheck="false">
          <button class="hidden-search"></button>
        </div>
        <button type="submit" class="header-search-btn df" tabindex="0" role="button">
          <span>
            Найти
          </span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "SearchComponent"
}
</script>

<style scoped>

</style>