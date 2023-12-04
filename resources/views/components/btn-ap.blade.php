<style>
    body {
        min-height: 2000px;
    }

    .btn-up {
        z-index: 2;
        position: fixed;
        background-color: #fd7e14;
        right: 20px;
        bottom: 20px;
        border-radius: 22px;
        cursor: pointer;
        width: 44px;
        height: 44px;
    }

    .btn-up::before {
        content: "";
        text-align: center;
        position: absolute;
        width: 20px;
        height: 20px;
        left: 12px;
        top: 12px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20'%3E%3Cg fill='none' stroke='%23fff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M10 17V4M3 10l7-7 7 7'/%3E%3C/g%3E%3C/svg%3E");
    }

    .btn-up_hide {
        display: none;
    }

    @media (hover: hover) and (pointer: fine) {
        .btn-up:hover {
            background-color: #fd7e14;
        }
    }
</style>


<div class="btn-up btn-up_hide"></div>

<script>
    const btnUp = {
        el: document.querySelector('.btn-up'),
        show() {
            // удалим у кнопки класс btn-up_hide
            this.el.classList.remove('btn-up_hide');
        },
        hide() {
            // добавим к кнопке класс btn-up_hide
            this.el.classList.add('btn-up_hide');
        },
        addEventListener() {
            // при прокрутке содержимого страницы
            window.addEventListener('scroll', () => {
                // определяем величину прокрутки
                const scrollY = window.scrollY || document.documentElement.scrollTop;
                // если страница прокручена больше чем на 400px, то делаем кнопку видимой, иначе скрываем
                scrollY > 400 ? this.show() : this.hide();
            });
            // при нажатии на кнопку .btn-up
            document.querySelector('.btn-up').onclick = () => {
                // переместим в начало страницы
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        }
    }
    btnUp.addEventListener();
</script>