<template>
</template>

<script>
export default {

  name: 'Logout',

  created() {
  	axios.post('/logout',{})
  	.finally(err => {
  		window.location = '/login';
  	});
  },
  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>