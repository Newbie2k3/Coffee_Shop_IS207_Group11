<section class="flex">
    
      <div>
        <img width="auto" src="https://raw.githubusercontent.com/letuyen2102/coffee_shop/letuyen-21522778/public/images/bg_2.jpg" alt="">
      </div>
      <div class="form bg-black">
        
        <form class="my-form" action="http://localhost/Coffee_Shop_IS207_Group11/coffee-shop/public/submit-form" method="post">
          @csrf
            <p class="fs-3">Yêu cầu tư vấn ngay</p>
                <div class="row">
                  <div class="col">
                    <input type="text" name='name' placeholder="Họ và tên" required>
                  </div>
                  <div class="col">
                    <input type="text" name='email'  placeholder="Email" required>
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="tel" id="phone" name="phone" placeholder="Số điện thoại"  required>
                    </div>
                    <div class="col">
                        <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                    </div>
                    <div>
                        <input  type="text" name='desc' placeholder="Để lại lời nhắn">
                    </div>
                </div>
            <div class="form-group mt-2 my-form">
              <label for="product">Sản phẩm quan tâm:</label>
              <select class="product" id="product" name="product" required>
                <option value="">Chọn sản phẩm</option>
                @foreach ($product as $item)
                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
           
            <input type="submit" value="Gửi ngay">
          </form>
      </div>
  
</section>