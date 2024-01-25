@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <h1 class="text-white m-3">About Us</h1>
        <div class="m-5">
            <h3 class="text-white">ARTECH: Unleashing Creative Potential</h3>
            <p class="text-white">Welcome to ARTECH, where innovation meets inspiration, and creativity knows no bounds. At
                ARTECH, we understand
                the challenges faced by visual artists, especially the daunting creative block that hinders the flow of
                imagination. Our mission is to empower and uplift the visual artists of Muntinlupa City by providing a
                revolutionary Art Recommendation System that acts as a catalyst for creativity.</p>
            <hr style="color: #F0F0F0">
            <h3 class="text-white">Our Vision</h3>
            <p class="text-white">At ARTECH, we envision a world where every artist, regardless of their background or
                experience, can break free from creative constraints. We aspire to be the driving force behind a thriving
                community of visual artists, fostering a dynamic and supportive environment that fuels artistic brilliance.
            </p>
            <hr style="color: #F0F0F0">
            <h3 class="text-white">The Creative Struggle</h3>
            <p class="text-white">We recognize the profound impact of creative block on the livelihood and artistic journey
                of visual artists. The struggle to generate new ideas and find fresh inspiration can lead to stagnation,
                affecting both the quality of work and an artist's standing in the art world. ARTECH is here to transform
                this narrative</p>
            <hr style="color: #F0F0F0">
            <h3 class="text-white">Our Solution - Art Recommendation System</h3>
            <p class="text-white">ARTECH introduces a groundbreaking solution - an Art Recommendation System designed
                exclusively for visual artists. This system employs advanced algorithms that analyze an artist's previous
                work, interests, and preferences to suggest a diverse range of prompts. By doing so, we aim to break the
                monotony, spark creativity, and ignite the passion that drives exceptional artistry.</p>
            <h3 class="text-white">How It Works</h3>
            <p class="text-white">Our Art Recommendation System encourages artists to explore new materials, techniques, and
                themes. By offering a variety of prompts tailored to individual preferences, artists can overcome creative
                blocks and discover innovative approaches to their craft. Whether you're a seasoned artist looking for a
                fresh perspective or a newcomer eager to embark on a creative journey, ARTECH is here to guide you.
            </p>
            <hr style="color: #F0F0F0">
            <h3 class="text-white">Join the ARTECH Revolution</h3>
            <p class="text-white">ARTECH is more than a platform; it's a movement to revolutionize the way artists overcome
                creative challenges. Join us in unleashing your creative potential and transforming the art landscape of
                Muntinlupa City. Together, let's break the chains of creative block and paint a vibrant future for visual
                artists.</p>
            <hr style="color: #F0F0F0">
        </div>
        <div class="row m-5">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ asset('icons/Alex.jpg') }}" alt=""
                            srcset="" class="border rounded-5" style="width: 200px; height:200px;">
                        <div class="mx-5">
                            <p class="text-center mt-4">My name's Alexandra Nicole Pecundo. 21 years of age. I currently
                                reside
                                in Bayanan, Muntinlupa
                                City. I'm a Senior in the BS Information Technology department of Pamantasan ng Lungsod ng
                                Muntinlupa. I like painting, Chess, and playing guitar.</p>
                        </div>
                        <h3>Alexandra Nicole</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ asset('icons/Angel.jpg') }}" alt=""
                            srcset="" class="border rounded-5" style="width: 200px; height:200px;">
                        <div class="mx-5">
                            <p class="text-center mt-4">I'm Angel Ann Postanes. Been alive for 21 years. I'm from Poblacion,
                                Muntinlupa City. a 4th Year
                                BS Information Technology student of Pamantasan ng Lungsod ng Muntinlupa. I'm the class
                                president of IT4B.</p>
                        </div>
                        <h3>Angel Ann</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="{{ asset('icons/Airhon.jpg') }}" alt=""
                            srcset="" class="border rounded-5" style="width: 200px; height:200px;">
                        <div class="mx-5">
                            <p class="text-center mt-4">My name is Airhon Sunga, and I am a fourth-year BSIT student from
                                Pamantasan ng Lungsod ng Muntinlupa. We are currently developing an Art Recommendation
                                System
                                with a virtual gallery. We can be more creative while learning as we continue to study.</p>
                        </div>
                        <h3>Airhon</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <h3 class="text-white">Artech</h3>
            <p class="text-white">Connect with us.</p>
            <div class="d-flex justify-content-around" style="width: 200px;">
                <a href="https://www.facebook.com/profile.php?id=61556156751237" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://www.instagram.com/artech0101/" class="text-white"> <i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
            </div>
        </div>
    </div>
    <hr style="color: #F0F0F0">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col d-flex flex-column align-items-center">
                <h5 class="text-white">Phone No</h5>
                <p class="text-white">(+63) 912 345 6789</p>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <h5 class="text-white">Email</h5>
                <p class="text-white">artech@gmail.com</p>
            </div>
        </div>
        <div class="d-flex justify-content-center m-5">
            <label for="" class="text-white"> Copyright © | Pamantasan ng Lungsod ng Muntinlupa | All rights
                reserved</label>
        </div>
    </div>
    </div>
@endsection
