# live2dv3_typecho_plugin
支持 Live2D v3版本模型(moc3、model3)的typecho插件

这个项目是融合了 <a href="https://github.com/Dreamer-Paul/Pio">@Dreamer-Paul</a> 和 <a href="https://github.com/HCLonely/Live2dV3">@HCLonely</a> 项目的产物，使用的模型是 <a href="https://space.bilibili.com/41848825">沐水</a>制作的lar。

本来打算直接用 <a href="https://github.com/Dreamer-Paul/Pio">@Dreamer-Paul</a>的插件，但是发现他的项目只支持一代的live2d，而我想使用的模型是三代的，所以就借助了 <a href="https://github.com/HCLonely/Live2dV3">@HCLonely</a>的项目搓了个能用 Live2D v3版本模型的插件

演示见我的博客：https://lapherder.tech

## 使用

0、给本项目一个star

1、把本项目中的文件夹`live2dv3`放入typecho的`usr/plugins/`目录下。

2、登入typecho后台，进入插件管理，启用`live2dv3`，并按需进行设置。

如果想使用自己的live2dv3模型，请将你的模型文件夹放在`live2dv3/models`下，并保证文件夹名`modelname`下模型配置文件命名为`modelname.model3.json`，然后在设置中启用你的模型。

## 关于模型

lar是游戏《The Lar》中的角色。

## 关于本项目

这个项目之后应该还会升级迭代，毕竟现在连关闭按钮都没有hhh。

没有文字框互动是因为我觉得很尬，所以没有加。

因为本人没学过php、js、css，所以这个项目基本是面向google/百度编程实现的，欢迎各路大佬指教修改。

