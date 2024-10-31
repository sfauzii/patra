<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>
        
        @include('includes.app.style')

    </head>

    <body>

        <!-- Navbar -->
        @include('includes.app.navbar')

        <!-- Content Section -->
        <section class="header-content">
            <div class="left-content">
                <h1>Fast and Easy Way To Rent A Car</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto molestias aspernatur, delectus
                    suscipit autem ut.</p>

                <div class="card-search">
                    <form>
                        <input type="text" placeholder="Search...">
                        <select>
                            <option value="">Select Brand</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                        </select>
                        <select>
                            <option value="">Select Type</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                        </select>
                        <button class="btn-primary" type="submit">Search</button>
                    </form>
                </div>

                <!-- Tambahkan gambar di sini -->
                <div class="extra-image">
                    <img src="frontend/images/list-many-more.svg" alt="Car Rental" />
                </div>

                <!-- New Image Below Card Search -->
            </div>
            <div class="right-content">
                <img src="frontend/images/hero.svg" alt="Image" />
            </div>
        </section>

        
        @yield('content')

        <!-- Footer -->
        @include('includes.app.footer')



        @include('includes.app.scripts')

    </body>

</html>