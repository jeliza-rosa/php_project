'use strict';

const toggleHidden = (...fields) => {

  fields.forEach((field) => {

    if (field.hidden === true) {

      field.hidden = false;

    } else {

      field.hidden = true;

    }
  });
};

const labelHidden = (form) => {

  form.addEventListener('focusout', (evt) => {

    const field = evt.target;
    const label = field.nextElementSibling;

    if (field.tagName === 'INPUT' && field.value && label) {

      label.hidden = true;

    } else if (label) {

      label.hidden = false;

    }
  });
};

const toggleDelivery = (elem) => {

  const delivery = elem.querySelector('.js-radio');
  const deliveryYes = elem.querySelector('.shop-page__delivery--yes');
  const deliveryNo = elem.querySelector('.shop-page__delivery--no');
  const fields = deliveryYes.querySelectorAll('.custom-form__input');

  delivery.addEventListener('change', (evt) => {

    if (evt.target.id === 'dev-no') {

      fields.forEach(inp => {
        if (inp.required === true) {
          inp.required = false;
        }
      });


      toggleHidden(deliveryYes, deliveryNo);

      deliveryNo.classList.add('fade');
      setTimeout(() => {
        deliveryNo.classList.remove('fade');
      }, 1000);

    } else {

      fields.forEach(inp => {
        if (inp.required === false) {
          inp.required = true;
        }
      });

      toggleHidden(deliveryYes, deliveryNo);

      deliveryYes.classList.add('fade');
      setTimeout(() => {
        deliveryYes.classList.remove('fade');
      }, 1000);
    }
  });
};

const filterWrapper = document.querySelector('.filter__list');
if (filterWrapper) {

  filterWrapper.addEventListener('click', evt => {

    const filterList = filterWrapper.querySelectorAll('.filter__list-item');

    filterList.forEach(filter => {

      if (filter.classList.contains('active')) {

        filter.classList.remove('active');

      }

    });

    const filter = evt.target;

    filter.classList.add('active');

  });

}

const shopList = document.querySelector('.shop__list');
if (shopList) {

  shopList.addEventListener('click', (evt) => {

    const prod = evt.path || (evt.composedPath && evt.composedPath());;

    if (prod.some(pathItem => pathItem.classList && pathItem.classList.contains('shop__item'))) {

      const shopOrder = document.querySelector('.shop-page__order');

      toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);

      window.scroll(0, 0);

      shopOrder.classList.add('fade');
      setTimeout(() => shopOrder.classList.remove('fade'), 1000);

      const form = shopOrder.querySelector('.custom-form');
      labelHidden(form);

      toggleDelivery(shopOrder);

      const buttonOrder = shopOrder.querySelector('.button_accept');
      const popupEnd = document.querySelector('.shop-page__popup-end');

      if (buttonOrder) {
              buttonOrder.addEventListener('click', (evt) => {

        form.noValidate = true;

        const inputs = Array.from(shopOrder.querySelectorAll('[required]'));

        inputs.forEach(inp => {

          if (!!inp.value) {

            if (inp.classList.contains('custom-form__input--error')) {
              inp.classList.remove('custom-form__input--error');
            }

          } else {

            inp.classList.add('custom-form__input--error');

          }
        });

        if (inputs.every(inp => !!inp.value)) {

          evt.preventDefault();

          toggleHidden(shopOrder, popupEnd);

          popupEnd.classList.add('fade');
          setTimeout(() => popupEnd.classList.remove('fade'), 1000);

          window.scroll(0, 0);

          const buttonEnd = popupEnd.querySelector('.button_accept');

          buttonEnd.addEventListener('click', () => {


            popupEnd.classList.add('fade-reverse');

            setTimeout(() => {

              popupEnd.classList.remove('fade-reverse');

              toggleHidden(popupEnd, document.querySelector('.intro'), document.querySelector('.shop'));

            }, 1000);

          });

        } else {
          window.scroll(0, 0);
          evt.preventDefault();
        }
      });
      }
    }
  });
}

const pageOrderList = document.querySelector('.page-order__list');
if (pageOrderList) {

  pageOrderList.addEventListener('click', evt => {


    if (evt.target.classList && evt.target.classList.contains('order-item__toggle')) {
      var path = evt.path || (evt.composedPath && evt.composedPath());
      Array.from(path).forEach(element => {

        if (element.classList && element.classList.contains('page-order__item')) {

          element.classList.toggle('order-item--active');

        }

      });

      evt.target.classList.toggle('order-item__toggle--active');

    }

    if (evt.target.classList && evt.target.classList.contains('order-item__btn')) {

      const status = evt.target.previousElementSibling;

      if (status.classList && status.classList.contains('order-item__info--no')) {
        status.textContent = 'Выполнено';
      } else {
        status.textContent = 'Не выполнено';
      }

      status.classList.toggle('order-item__info--no');
      status.classList.toggle('order-item__info--yes');

    }

  });

}

const checkList = (list, btn) => {

  if (list.children.length === 1) {

    btn.hidden = false;

  } else {
    btn.hidden = true;
  }

};
const addList = document.querySelector('.add-list');
if (addList) {

  const form = document.querySelector('.custom-form');
  labelHidden(form);

  const addButton = addList.querySelector('.add-list__item--add');
  const addInput = addList.querySelector('#product-photo');

  checkList(addList, addButton);

  addInput.addEventListener('change', evt => {

    const template = document.createElement('LI');
    const img = document.createElement('IMG');

    template.className = 'add-list__item add-list__item--active';
    template.addEventListener('click', evt => {
      addList.removeChild(evt.target);
      addInput.value = '';
      checkList(addList, addButton);
    });

    const file = evt.target.files[0];
    const reader = new FileReader();

    //загрузка картинки при создании товара
    reader.onload = (evt) => {
      img.src = evt.target.result;
      template.appendChild(img);
      addList.appendChild(template);
      checkList(addList, addButton);
    };

    reader.readAsDataURL(file);

  });

  const button = document.querySelector('.button_accept');
  const popupEnd = document.querySelector('.page-add__popup-end');

  if (button) {
      button.addEventListener('click', (evt) => {

      evt.preventDefault();

      form.hidden = true;
      popupEnd.hidden = false;

    })
  }
}

const productsList = document.querySelector('.page-products__list');
if (productsList) {
  productsList.addEventListener('click', evt => {
    const target = evt.target;
    if (target.classList && target.classList.contains('product-item__delete')) {
      productsList.removeChild(target.parentElement);
    }
  });
}

// jquery range maxmin
if (document.querySelector('.shop-page')) {
  fetch('/src/max_min_price_range.php', {
    method: "GET"
  })
  .then(res => {return res.json()})
  .then(data => {
    const max = Number(data[0]['max(price)'].substr(0, data[0]['max(price)'].length-3));
    const min = Number(data[0]['min(price)'].substr(0, data[0]['min(price)'].length-3));
      $('.range__line').slider({
    min: min,
    max: max,
    values: [350, 32000],
    range: true,
    stop: function(event, ui) {

      $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
      $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');

    },
    slide: function(event, ui) {

      $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
      $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');
    }
  });
  })
};

//собрать параметры со страницы
function x() {
  let minPrice = document.querySelector('.min-price').textContent.substr(0, document.querySelector('.min-price').textContent.length-5).replace(' ', '');
  let maxPrice = document.querySelector('.max-price').textContent.substr(0, document.querySelector('.max-price').textContent.length-5).replace(' ', '');

  let x = new URLSearchParams(window.location.search);

  //объект с параметрами фильтрации
  let formData = {};

  formData.chapter = x.get('chapter');

  if (x.get('chapter') === null) {
    delete formData.chapter;
  }

  if (minPrice !== '350') {
    formData.minPrice = minPrice
  };

  if (maxPrice !== '32000') {
    formData.maxPrice = maxPrice
  };

  if (Number(document.querySelector('#new').checked) !== 0) {
    formData.novelty = Number(document.querySelector('#new').checked);
  };

  if (Number(document.querySelector('#sale').checked) !== 0) {
    formData.sale = Number(document.querySelector('#sale').checked);
  };

  if (document.querySelectorAll('.custom-form__select')[0].value != 'Сортировка') {
    formData.sort = document.querySelectorAll('.custom-form__select')[0].value;
  };

  if (document.querySelectorAll('.custom-form__select')[1].value != 'Порядок') {
    formData.order = document.querySelectorAll('.custom-form__select')[1].value;
  };

  return formData;
}

//отправить запрос
async function fullParameters(formData) {

  var searchParams = new URLSearchParams(window.location.search);

  //добавить параметры в адресную строку
  var searchParams = new URLSearchParams(formData);

  //если уже есть параметры
  if (searchParams.toString().length !== 0) {
    history.pushState(null, null, '?' + searchParams);
  }

  //отправляем запрос в для получения списка товаром, соответсвущего фильтрам
  const response = await fetch(`src/get_products_chapter_markup.php${window.location.search}`, {
    method: "GET",
    headers: {
      'Content-Type': 'application/json; charset=UTF-8'
    }
  });

  const data = await response.json();

  return data;
};

let price;

function pagination(data) {
  //строка без цифры в начале
  const dataMarkup = data.substr(data.indexOf('<'));

  if (document.querySelector('.shop__list')) {
    document.querySelector('.shop__list').innerHTML = dataMarkup;
  }
  
  //формирование надписи о кол-ве моделей
  const numberProducts = data.substr(0, data.indexOf('<')); //количество моделей, соответствующее фильтрам

  const lastSymbol = numberProducts.slice(-1);

  let models;

  if (numberProducts.slice(-1) == 2 || numberProducts.slice(-1) == 3 || numberProducts.slice(-1) == 4) {
    models = 'и';
  } else if (numberProducts.slice(-1) == 1) {
    models = 'ь';
  } else {
    models = 'ей';
  };

  if (numberProducts >= 11 && numberProducts <= 19) {
    models = 'ей';
  };

  if (document.querySelector('.shop__sorting-res')) {
    document.querySelector('.shop__sorting-res').innerHTML = `Найдено ${numberProducts} модел${models}`;
  };

  if (numberProducts == '') {
    document.querySelector('.shop__list').innerHTML = 'Товары с такими параметрами не надены';
    document.querySelector('.shop__sorting-res').innerHTML = `Найдено 0 моделей`;
  };

  //пагинация
  const numberBtnsPagination = Math.ceil(numberProducts/12);

  if (document.querySelector('.shop__paginator')) {
    document.querySelector('.shop__paginator').innerHTML = '';
  }

  //создание кнопок пагинации
  var searchParams = new URLSearchParams(window.location.search)
  for (let i = 0; i < numberBtnsPagination; i++) {
    const liPagination = document.createElement('li');
    const linkPagination = document.createElement('a');
    linkPagination.classList.add('paginator__item');
    linkPagination.setAttribute('href', '');
    linkPagination.textContent = i+1;

    liPagination.append(linkPagination);
    if (document.querySelector('.shop__paginator')) {
      document.querySelector('.shop__paginator').append(liPagination);
    };

    if (searchParams.get('page') == i+1) {
      linkPagination.removeAttribute('href');
    };

    if (searchParams.get('page') == null && i===0) {
      linkPagination.removeAttribute('href');
    }
  }
  
  document.querySelectorAll('.paginator__item').forEach((el) => {
    el.addEventListener('click', (btn) => {
      btn.preventDefault();

      paginationClick(el);
    });
  });

  document.querySelectorAll('.product').forEach((el) => {
    el.addEventListener('click', (btn) => {
      btn.preventDefault();

      price = el.children[2].textContent.substr(0, el.children[2].textContent.length - 4);
    })
  })
};

function paginationClick(el) {
  var searchParams = new URLSearchParams(window.location.search);

  if ((el.textContent == searchParams.get('page')) || (searchParams.get('page') == null && el.textContent == 1)) {
    return false;
  }

  searchParams.set('page', el.textContent);
  history.pushState({}, '?', '?' + searchParams);

  fullParameters().then(data => pagination(data));
  
  el.removeAttribute('href');
}

//Загрузка страницы
document.addEventListener('DOMContentLoaded', async() => {
  //страница с товарами
  if(!window.location.href.includes('admin')) {
    fullParameters().then(data => pagination(data));

    var searchParams = new URLSearchParams(window.location.search);
    const maxBall = 100 - ((32000 - searchParams.get('maxPrice'))/31650).toFixed(2)*100;
    const minBall = ((searchParams.get('minPrice') - 350)/31650).toFixed(2)*100;

    for (let i=1; i<document.querySelectorAll('.filter__list-item').length; i++) {
      if (document.querySelectorAll('.filter__list-item')[i].textContent == searchParams.get('chapter')) {
        document.querySelectorAll('.filter__list-item')[0].classList.remove('active');
        document.querySelectorAll('.filter__list-item')[i].classList.add('active');
      }
    }

    if (searchParams.has('novelty')) {
      document.querySelectorAll('.custom-form__checkbox')[0].setAttribute('checked', 'checked');
    };

    if (searchParams.has('sale')) {
      document.querySelectorAll('.custom-form__checkbox')[1].setAttribute('checked', 'checked');
    };

    if (searchParams.has('sort')) {
      document.querySelector(`.custom-form__select option[value="${searchParams.get('sort')}"]`).setAttribute('selected', 'selected');
    };

    if (searchParams.has('order')) {
      document.querySelector(`.custom-form__select option[value="${searchParams.get('order')}"]`).setAttribute('selected', 'selected');
    };
   };

   if(window.location.href.includes('orders')) {
    const response = await fetch(`/src/get_cookie_login.php`, {
      method: "GET",
      headers: {
        'Content-Type': 'application/json; charset=UTF-8'
      }
    });

    const data = await response.json();
    };

   if(window.location.href.includes('novelty')) {
      const allLink = document.querySelectorAll('.main-menu__item');

      allLink.forEach((link) => {
        link.classList.remove('active');
      });

      document.querySelector('.main-menu__item-new').classList.add('active');
   };

    if(window.location.href.includes('sale')) {
      const allLink = document.querySelectorAll('.main-menu__item');

      allLink.forEach((link) => {
        link.classList.remove('active');
      });

      document.querySelector('.main-menu__item-sale').classList.add('active');
   };
});

//Клик по категориям
document.querySelectorAll('.filter__list-item').forEach((el) => {
  el.addEventListener('click', async(link) => {
    link.preventDefault();
    history.pushState(null, null, `?chapter=${el.textContent}`)
    const formData = x();
    fullParameters(formData).then(data => pagination(data));
    link.preventDefault();
  });
});

//клик по "Принять
if (document.querySelector('.button_accept')) {
  document.querySelector('.button_accept').addEventListener('click', (btn) => {
    btn.preventDefault();

    const formData = x();
    fullParameters(formData).then(data => pagination(data));
  });
};

//выбор сортировки и порядка
document.querySelectorAll('.custom-form__select_shop').forEach((el) => {
  el.addEventListener('change', () => {

    const formData = x();
    fullParameters(formData).then(data => {

    pagination(data)
    });
  });
});

//ссылка Новинки
if (document.querySelector('.main-menu__item-new')) {
  document.querySelector('.main-menu__item-new').addEventListener('click',(el) => {
    el.preventDefault();

    history.pushState(null, null, '/');

    fullParameters({novelty: 1}).then(data => pagination(data));
    location.reload();
    if (document.querySelectorAll('.custom-form__checkbox')[0]) {
      document.querySelectorAll('.custom-form__checkbox')[0].setAttribute('checked', 'checked');
      document.querySelectorAll('.custom-form__checkbox')[1].removeAttribute('checked');
    }

    const allLink = document.querySelectorAll('.main-menu__item');
  });
}

//ссылка Sale
if (document.querySelector('.main-menu__item-sale')) {
  document.querySelector('.main-menu__item-sale').addEventListener('click',(el) => {
    el.preventDefault();

    history.pushState(null, null, '/');

    fullParameters({sale: 1}).then(data => pagination(data));
    location.reload();
    if (document.querySelectorAll('.custom-form__checkbox')[1]) {
      document.querySelectorAll('.custom-form__checkbox')[1].setAttribute('checked', 'checked');
      document.querySelectorAll('.custom-form__checkbox')[0].removeAttribute('checked');
    }
  });
}

//Форма Авторизации
if (document.querySelector('.btn-authorization')) {
  document.querySelector('.custom-form-authorization').addEventListener('submit', async (el) => {
    el.preventDefault();

    const valueLogin = document.querySelector('input[type="email"]').value;
    const valuePassword = document.querySelector('input[type="password"]').value;

    var pattern  = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (valueLogin == '' || valuePassword == '') {
      alert('Введите логин и пароль');
    } else if (pattern.test(valueLogin)) {

      var data = new FormData(el.target);

      fetch(`/src/check_enter.php`, {
        method: "POST",
        body: data,
      })
      .then(res => { return res.json(); })
      .then(data => {
        if (data) {
          history.pushState(null, null, '/orders.php');
          location.reload();
        } else {
          alert('Неверный логин или пароль');
        }
      });
    } else {
      alert('Введите корректный email');
    };
  });
}

//для оформления заказа
if (document.querySelector('.btn_order')) {
  document.querySelector('.btn_order').addEventListener('click', (el) => {
    el.preventDefault();
    let fieldСompletion;

    document.querySelector('.page-header').scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });

    let dataOrder = {};
    const surname = document.querySelector('#surname').value;
    const name = document.querySelector('#name').value;
    const thirdName = document.querySelector('#thirdName').value;
    const phone = document.querySelector('#phone').value;
    const mail = document.querySelector('#email').value;
    const deliveryTypes = document.querySelectorAll('.custom-form__radio[name="delivery"]');
    let delivery;

    for (let i = 0; i < deliveryTypes.length; i++) {
      if (deliveryTypes[i].checked) {
         delivery = i;
      };
    };

    const payTypes = document.querySelectorAll('.custom-form__radio[name="pay"]');
    let pay;

    for (let i = 0; i < payTypes.length; i++) {
      if (payTypes[i].checked) {
         pay = i;
      };
    };

    const comment = document.querySelector('.custom-form__textarea').value;

    if (surname == '' || name == '' || phone == '' || mail == '') {
      alert('Заполните все обязательные поля');
      fieldСompletion = false;
    } else {
      dataOrder.surname = surname;
      dataOrder.name = name;
      dataOrder.thirdName = thirdName;
      dataOrder.phone = phone;
      dataOrder.mail = mail;
      dataOrder.delivery = deliveryTypes[delivery].value;
      dataOrder.pay = payTypes[pay].value;
      dataOrder.comment = comment;
      dataOrder.price = price;
      fieldСompletion = true;

      if (delivery) {
        const city = document.querySelector('#city').value;
        const street = document.querySelector('#street').value;
        const house = document.querySelector('#home').value;
        const apartment = document.querySelector('#aprt').value;

        if (city == '' || street == '' || house == '' || apartment == '') {
          alert('Заполните все обязательные поля');
          fieldСompletion = false;
          dataOrder = {};
        } else {
          dataOrder.city = city;
          dataOrder.street = street;
          dataOrder.house = house;
          dataOrder.apartment = apartment;

          fieldСompletion = true;
        };
      };
    };

    if (fieldСompletion) {
      var data = new FormData();
      data.append("json", JSON.stringify(dataOrder));

      fetch(`/src/send_order.php`, {
        method: "POST",
        body: data,
      })
      .then(res => { return res.json(); })
      .then(data => { 
        document.querySelector('.shop-page__order').setAttribute("hidden", "");
        document.querySelector('.shop-page__popup-end').removeAttribute("hidden");
        document.querySelector('.btn-continue-shopping').addEventListener('click', () => {
          history.pushState(null, null, '/');
          location.reload();
        })
      })
    }
  })
};

//перейти в товары
document.querySelectorAll('.main-menu__item')[1].addEventListener('click', async (el) => {
  if (document.querySelectorAll('.main-menu__item')[1].textContent == 'Товары') {
    el.preventDefault();
    
    const response = await fetch(`/src/get_cookie_login.php`, {
      method: "GET",
      headers: {
        'Content-Type': 'application/json; charset=UTF-8'
      }
    });

    const data = await response.json();

    if (data != 'admin@mail.ru') {
      alert('Раздел доступен только для администратора');
    } else {
      history.pushState(null, null, '/products.php');
      location.reload();
    }
  };
});

//выход
document.querySelectorAll('.main-menu__item').forEach((el) => {
  if (el.textContent == 'Выйти') {
    el.addEventListener('click', async (btn) => {
      btn.preventDefault();
      
      const response = await fetch(`/src/exit.php`, {
        method: "GET",
        headers: {
          'Content-Type': 'application/json; charset=UTF-8'
        }
      });

    history.pushState(null, null, '/admin');
    location.reload();
    })
  }
})

//изменить статус заказа
if (document.querySelector('.order-item__btn')) {
  document.querySelectorAll('.order-item__btn').forEach((el) => {
    el.addEventListener('click', (change) => {
      const idOrder = el.parentElement.parentElement.parentElement.children[0].children[0].children[1].textContent;
      let status;

      if (el.parentElement.querySelector('.order-item__info').classList.contains('order-item__info--yes')) {
        status = 0;
      } else {
        status = 1;
      }

      const dataOrder = {
        id: idOrder,
        status: status
      };

      var data = new FormData();
      data.append("json", JSON.stringify(dataOrder));

      fetch(`/src/change_status_order.php`, {
        method: "POST",
        body: data,
      })
      .then(res => { return res.json(); });  
    });
  });
};

//удалить товар
if (document.querySelector('.product-item__delete')) {
  document.querySelectorAll('.product-item__delete').forEach((el) => {
    el.addEventListener('click', (del) => {

      const idProduct = el.parentElement.children[1].textContent;

      const dataProductDel = {
        id: idProduct
      };

      var data = new FormData();
      data.append("json", JSON.stringify(dataProductDel));

      fetch(`/src/delete_product.php`, {
        method: "POST",
        body: data,
      })
      .then(res => { return res.json(); });
    });
  });
};

let editOrCreate = '';
let id = '';

//создание нового товара/изменение товара
if (document.querySelector('.form-add-change')) {

  fetch(`/src/get_cookie_login.php`, {
          method: "GET",
        })
  .then(res => { return res.json() })

  const id = getIdProductEdit().then(id => {
      if (!id) {
        document.querySelector('.custom-form').addEventListener('submit', (event) => {
        event.preventDefault();
        const data = new FormData(event.target);

        fetch(`/src/add_product.php`, {
          method: "POST",
          body: data,
        })
        .then(res => { return res.json()})
        .then(data => {
          if (data) {
            alert('Товар успешно добавлен');
            history.pushState(null, null, '/products.php');
            location.reload();
          } else {
            alert('Ошибка добавления товара. Возможно заполнены не все поля.');
          }
        })
      })
    } else {
      let img = '';
      document.querySelector('.h--1').textContent = 'Редактирование товара';
      document.querySelector('.btn_add').textContent = 'Изменить товар';

      const editProduct = {
        id: id
      };

      var data = new FormData();
      data.append("json", JSON.stringify(editProduct));

      fetch(`/src/get_product_where_id.php`, {
        method: "POST",
        body: data
      })
      .then(res => { return res.json()})
      .then(data => {
        document.querySelector('#product-name').value = data[0].name;
        document.querySelectorAll('.custom-form__input-label').forEach((el) => {
          el.textContent = '';
        })
        document.querySelector('#product-price').value = data[0].price;
        for (let i = 0; i < data.chapter_name.length; i++) {
          for (let j = 1; j < document.querySelectorAll('option').length; j++) {
            if (data.chapter_name[i] == document.querySelectorAll('option')[j].textContent) {
              document.querySelectorAll('option')[j].selected = true;
            }
          }
        };
        if (data[0].novelty == 1) {
          document.querySelector('#new').checked = true;
        };
        if (data[0].sale == 1) {
          document.querySelector('#sale').checked = true;
        };

        document.querySelector('.add-list__item--add').hidden = true;

        const li = document.createElement('li');
        const img = document.createElement('img');

        img.src = `/img/products/${data[0].image}`;

        li.classList.add('add-list__item', 'add-list__item--active');

        li.append(img);
        document.querySelector('.add-list').append(li);

        li.addEventListener('click', () => {
          li.remove();
          document.querySelector('.add-list__item--add').hidden = false;
        })
      })


      document.querySelector('.custom-form').addEventListener('submit', (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append('id', id);

        fetch(`/src/change_product.php`, {
          method: "POST",
          body: data,
        })
        .then(res => { return res.json()})
        .then(data => {
          if (data) {
            alert('Товар успешно изменен');
            history.pushState(null, null, '/products.php');
            location.reload();

            fetch(`/src/delete_cookie_id.php`, {
              method: "GET",
            })
          } else {
            alert('Ошибка Изменения товара. Возможно заполнены не все поля.');
          }
        })
      });
    };
  });
};

//редактирование товара(добавить id в cookie)
if (document.querySelector('.product-item__edit')) {
  document.querySelectorAll('.product-item__edit').forEach((el) => {
    el.addEventListener('click', () => {
      const editProduct = {
        id: el.parentElement.children[1].textContent
      };

      var data = new FormData();
      data.append("json", JSON.stringify(editProduct));

      fetch(`/src/create_cookie_edit_product.php`, {
        method: "POST",
        body: data
      })
      .then(res => { return res.json()});
    })
  })
}

//получить из куки id продукта
async function getIdProductEdit() {
  const response = await fetch(`/src/get_cookie_id_product.php`, {
    method: "GET",
    headers: {
      'Content-Type': 'application/json; charset=UTF-8'
    }
  });

  const data = await response.json();
  return data;
}


