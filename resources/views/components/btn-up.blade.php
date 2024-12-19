{{--
************************************************************************************
************************************************************************************
***********                                                                  *******
*********** Сильно не заморачиваемся, не разбиваем CSS и JavaScript на файлы *******
***********                                                                  *******
************************************************************************************
************************************************************************************
--}}


<style>

    .btn-up {
        z-index: 2;
        position: fixed;
        background-color: #fd7e14;
        right: 20px;
        bottom: 0px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 50px;
    }

    .btn-up::before {
        content: "";
        width: 40px;
        height: 40px;
        background: transparent no-repeat center center;
        background-size: 100% 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23fff' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z'/%3E%3C/svg%3E");
    }

    .btn-up_hide {
        display: none;
    }

    @media (hover: hover) and (pointer: fine) {
        .btn-up:hover {
            background-color: #fd5310;
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
    };

    btnUp.addEventListener();

</script>