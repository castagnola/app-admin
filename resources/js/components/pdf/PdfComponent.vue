<template>
    <div class="container">
        <h1>Generación PDF</h1>
<!--        <a href="{{route('imprimir')}}">Imprimir PDF</a>-->
        <button @click="downloadCoverLetter()">Imprimir</button>

    </div>
</template>

<script>
    export default {
        name: "PdfComponent",
        methods:{
            async downloadCoverLetter() {
                axios({
                    url: '/imprimir-pdf',
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'file.pdf');
                    document.body.appendChild(link);
                    link.click();
                });
            }
        }
    }
</script>

<style scoped>

</style>
