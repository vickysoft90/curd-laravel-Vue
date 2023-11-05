<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Beutics.com </router-link>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        
                        <li class="nav-item" exact-active-class="active">
                            <router-link to="/category" class=" nav-link">Category</router-link>
                        </li>
                        <li class="nav-item" exact-active-class="active">
                            <router-link to="/tag" class=" nav-link">Tag</router-link>
                        </li>
                        <li class="nav-item" exact-active-class="active">
                            <router-link to="/product" class=" nav-link">Product</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {}
</script>