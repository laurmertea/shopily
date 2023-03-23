    <footer>
        <div class="footer_container">
            Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a>,
            <a href="https://roundicons.com/" title="Roundicons">Roundicons</a>
            and <a href="https://www.flaticon.com/authors/flat-icons" title="Flat Icons">Flat Icons</a> 
            from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
        </div>
    </footer>

    <script>
        function hide() {
            const listsEl = document.querySelector('#content');
            const listEl = document.querySelector('#current-list');
            const itemsEl = document.querySelector('#current-items');

            listsEl.classList.remove('flex');
            listsEl.classList.add('flex-center');
            listsEl.classList.remove('flex-grow-1');
            listEl.style.display='none';
        }
        function show(list) {
            const listsEl = document.querySelector('#content');
            const listEl = document.querySelector('#current-list');
            const itemsEl = document.querySelector('#current-items');
            const itemsListEl = document.querySelector('#current-items-list');
            
            itemsListEl.innerHTML = `<li><a id="add-item" onClick="toggleAddItem();" href="#">Add an item</a></li>`;

            if (listsEl.classList.contains('flex-center')) {
                listsEl.classList.remove('flex-center');
                listsEl.classList.add('flex');
                listsEl.classList.add('flex-grow-1');
                listEl.style.display='block';
                itemsEl.style.display='block';
            }

            const listStatusEl = document.querySelector('#current-list-status');
            listStatusEl.classList.add('status');

            if (list.completed === "1") {
                if (listStatusEl.classList.contains('active')) listStatusEl.classList.remove('active');
                listStatusEl.classList.add('finished');
                listStatusEl.title = 'Completed';
            } else {
                if (listStatusEl.classList.contains('finished')) listStatusEl.classList.remove('finished');
                listStatusEl.classList.add('active');
                listStatusEl.title = 'Active';
            }
            const listDescriptionEl = document.querySelector('#current-list-description');
            listDescriptionEl.textContent = list.description;
            const listCreatedEl = document.querySelector('#current-list-created');
            listCreatedEl.textContent = `[${list.created_on}]`;
            const listTitleEl = document.querySelector('#current-list-title');
            listTitleEl.textContent = list.title;
            
            // console.log(list.items.length);
            list.items.forEach(element => { itemsListEl.innerHTML += `<li style="display: flex;"><div id="delete-list-item-${element.id}" style="cursor: pointer;"><form action="deleteItem" method="post"><input type="hidden" name="id" value="${element.id}"><input style="background-color: red; color: white;" id="delete_item_btn" value="Delete" type="submit"></form></div><input type="checkbox" id="list-item-${element.id}" name="list-${element.list_id}-${element.id}" ${element.completed == 1 && `checked`}>${element.title}</input></li>`; });


            // itemsListEl.textContent = JSON.stringify(list.items);
        }

        function toggleAddItem() {
            const addItemFormEl = document.querySelector('#add-item-form');
            const addItemEl = document.querySelector('#add-item');
            if (addItemFormEl.classList.contains('grid')) { 
                addItemFormEl.classList.remove('grid');
                addItemFormEl.classList.add('hidden');
                addItemEl.textContent = "Add an item";
            } else {
                addItemFormEl.classList.remove('hidden');
                addItemFormEl.classList.add('grid');
                addItemEl.textContent = "Close";
            }            
        }
    </script>
</body>
</html>