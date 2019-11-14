<?php
namespace PHPSTORM_META;

override(\Bigcommerce\MockInjector\MockInjector::getProphecy(0), map(['' => '@']));
override(\Bigcommerce\MockInjector\AutoMockingTest::autoMock(0), map(['' => '@']));
override(\Bigcommerce\MockInjector\AutoMockingTest::createWithMocks(0), map(['' => '@']));

override(\PHPUnit\Framework\TestCase::prophesize(0), map(['' => '@']));
override(\PHPUnit\Framework\TestCase::createMock(0), map(['' => '@']));


override(\Prophecy\Argument::type(0), map(['' => '@']));
override(\Prophecy\Argument::that(0), map(['' => 'mixed']));
override(\Prophecy\Argument::any(0), map(['' => 'mixed']));
override(\Prophecy\Argument::cetera(0), map(['' => 'mixed']));
override(\Prophecy\Prophecy\ObjectProphecy::reveal(0), map(['' => 'mixed']));
