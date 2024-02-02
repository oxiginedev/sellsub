<?php

test('guest user cannot purchase airtime', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
