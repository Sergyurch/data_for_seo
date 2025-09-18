import './bootstrap';
import $ from 'jquery';
import Swal from 'sweetalert2';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    $('#submit').on('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Зачекайте...',
            text: 'Іде обробка запиту',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        const keyword = $('input[name="keyword"]').val();
        const site = $('input[name="site"]').val();
        const location = $('input[name="location"]').val();
        const language = $('select[name="language"]').val();

        $('#errors').empty();

        $.ajax({
            url: '/search',
            method: 'POST',
            dataType: 'json',
            data: {
                keyword,
                site,
                location,
                language
            },
            success: function(response) {
                Swal.close();

                let html = `
                    <p>Статус: ${response.status_message}</p>
                    <p>Позиція сайту:  ${response.rank_absolute ?? 'Не знайдено'}</p>
                `;

                if (response.check_url) {
                    html += `<p>URL для перевірки: <a href="${response.check_url}" class="text-blue-600 hover:underline" target="_blank">Сторінка пошукових результатів</a></p>`;
                }

                $('#result').html(html);
            },
            error: function(xhr) {
                Swal.close();

                let html = '<ul>';

                xhr.responseJSON.errors.forEach(function(e) {
                    html += '<li>' + e + '</li>';
                });
                
                html += '</ul>';
                
                $('#errors').html(html);
            }
        });
    });
});
