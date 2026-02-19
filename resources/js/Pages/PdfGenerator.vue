<template>
    <div>
        <h2>Generate PDF</h2>
        <textarea v-model="pdfData" placeholder="Enter data for PDF"></textarea>
        <button @click="generatePdf">Generate PDF</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pdfData: ''
        };
    },
    methods: {
        async generatePdf() {
            const response = await fetch('/pdf_generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },
                body: JSON.stringify({
                    data: this.pdfData
                })
            });

            if (response.ok) {
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'shops.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
            } else {
                alert('Failed to generate PDF');
            }
        }
    }
};
</script>