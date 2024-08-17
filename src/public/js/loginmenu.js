'use strict';
{
    const recommend = document.getElementById('recommend');
    const myList = document.getElementById('myList');

    recommend.addEventListener('click',()=>{
        recommend.classList.add('active');
        myList.classList.remove('active');
    });

    myList.addEventListener('click',()=>{
        recommend.classList.remove('active');
        myList.classList.add('active');
    });
}