          <h5>Фильтры</h5>

          {{-- Бренд --}}
          <div class="mb-3">
              <label for="brand">Бренд</label>
              <select name="brand" id="brand" class="form-control">
                  <option value="">Все бренды</option>
                  @foreach ($items->unique('brand') as $item)
                  <option value="{{ $item->brand }}" {{ request('brand') == $item->brand ? 'selected' : '' }}>
                      {{ $item->brand }}
                  </option>
                  @endforeach
              </select>
          </div>

          {{-- Мощность --}}
          <div class="mb-3">
              <label for="power">Мощность</label>
              <select name="power" id="power" class="form-control">
                  <option value="">Все мощности</option>
                  @foreach ($items->unique('power') as $item)
                  <option value="{{ $item->power }}" {{ request('power') == $item->power ? 'selected' : '' }}>
                      {{ $item->power }} Вт
                  </option>
                  @endforeach
              </select>
          </div>

          {{-- Страна --}}
          <div class="mb-3">
              <label for="madein">Страна</label>
              <select name="madein" id="madein" class="form-control">
                  <option value="">Все страны</option>
                  @foreach ($items->unique('madein') as $item)
                  <option value="{{ $item->madein }}" {{ request('madein') == $item->madein ? 'selected' : '' }}>
                      {{ $item->madein }}
                  </option>
                  @endforeach
              </select>
          </div>

          {{-- Тип цоколя --}}
          <div class="mb-3">
              <label for="basetype">Тип цоколя</label>
              <select name="basetype" id="basetype" class="form-control">
                  <option value="">Все типы цоколя</option>
                  @foreach ($items->unique('basetype') as $item)
                  <option value="{{ $item->basetype }}" {{ request('basetype') == $item->basetype ? 'selected' : '' }}>
                      {{ $item->basetype }}
                  </option>
                  @endforeach
              </select>
          </div>

          {{-- Тип --}}
          <div class="mb-3">
              <label for="type">Тип</label>
              <select name="type" id="type" class="form-control">
                  <option value="">Все типы</option>
                  @foreach ($category->types as $type)
                  <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                      {{ $type->name }}
                  </option>
                  @endforeach
              </select>
          </div>

          {{-- Цена от и до --}}
          <div class="mb-3">
              <label>Цена (от и до)</label>
              <div class="d-flex gap-2">
                  <input type="number" name="price_from" class="form-control" placeholder="от" value="{{ request('price_from') }}">
                  <input type="number" name="price_to" class="form-control" placeholder="до" value="{{ request('price_to') }}">
              </div>
          </div>

          {{-- Только в наличии --}}
          <div class="mb-3 form-check">
              <input type="checkbox" name="in_stock" value="1" class="form-check-input" {{ request('in_stock') ? 'checked' : '' }}>

              <label for="in_stock" class="form-check-label">Только в наличии</label>
          </div>

          {{-- Кнопки --}}
          <div class="d-flex flex-column gap-2">
              <button type="submit" class="btn btn-primary">Применить</button>
              <a href="{{ route('categories.items', $category->id) }}" class="btn btn-danger">Сбросить</a>
          </div>


          <style>
              .filter-form {
                  background: linear-gradient(135deg, #ffffff, #f4f6f9);
                  border-radius: 12px;
                  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
                  padding: 25px;
                  transition: all 0.3s ease-in-out;
                  position: sticky;
                  top: 20px;
              }

              .filter-form h5 {
                  font-size: 1.4rem;
                  font-weight: 700;
                  color: #2c3e50;
                  margin-bottom: 25px;
                  position: relative;
              }

              .filter-form .mb-3 label {
                  font-weight: 600;
                  color: #34495e;
                  margin-bottom: 5px;
                  display: block;
              }

              .filter-form select,
              .filter-form input[type="number"] {
                  border-radius: 8px;
                  border: 1px solid #ced4da;
                  padding: 10px;
                  width: 100%;
                  background-color: #fff;
                  transition: all 0.2s ease;
              }

              .filter-form select:focus,
              .filter-form input[type="number"]:focus {
                  border-color: #007bff;
                  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
              }

              .filter-form .form-check-input {
                  margin-top: 4px;
              }

              .filter-form .form-check-label {
                  font-weight: 500;
                  color: #555;
              }

              .filter-form .btn {
                  transition: all 0.2s ease-in-out;
              }

              .filter-form .btn-primary {
                  background-color: #0069d9;
                  border-color: #0062cc;
              }

              .filter-form .btn-danger {
                  background-color: #e74c3c;
                  border-color: #e74c3c;
              }

              .filter-form .btn:hover {
                  transform: scale(1.02);
                  opacity: 0.95;
              }
          </style>