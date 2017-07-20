<div class="hidden-area">
    <input type="hidden" name="chart_type" value="" />
    <input type="hidden" name="chart_title" value="" />

    <button type="button" class="btn_popup xe-btn xe-btn-primary" style="width: 100%">차트 상세 설정</button>
</div>

<script type="text/javascript">
    $('.btn_popup').on('click', function () {
        window.open('{{ route('chart_widget::popup') }}', 'createPopup', "width=950,height=900,directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no");
    });
</script>