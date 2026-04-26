<script src="https://unpkg.com/lucide@latest"></script>

<div onclick="goToPage()" class="cursor-pointer">
    <div class="flex items-center gap-2">
        <i data-lucide="arrow-left"></i>
        <p class="text-2xl font-semibold text-primary-8">Back</p>
    </div>
</div>


<script>
    lucide.createIcons();

    function goToPage() {
        window.location.href = "/login";
    }
</script>