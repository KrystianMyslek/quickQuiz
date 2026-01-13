<template>
    <main>
        <Head :title="$page.component.slice($page.component.indexOf('/')+1).toUpperCase()" />
        
        <slot />
    </main>
</template>
