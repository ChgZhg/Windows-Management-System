   M S B A M L   `   `   `  ����  
WindowsCMS    WindowsCMS.CourseChose   5   	   R NWindowsBase, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35W SPresentationCore, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35D 9http://schemas.microsoft.com/winfx/2006/xaml/presentation    5   	   R NSystem.Xaml, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   -   5          � AllowsTransparency  .  J� OpacityMask
 ����� � WindowStyle$
 None=�5   @    � Topmost . 
������  � Title$ CourseChose��5   	   $	��300��6   $	��400��6*   $	��500��67   $	��500��6G   $	��300��6W   $	��400��6f    � WindowStartupLocation$ CenterScreen=�6u   .��5      ��  �� CornerRadius$ 5��6   
�������$��2q�61   
�������._�5   
   � .+�5      �� .+�5      �� $��18(�6   $��Center=�6&   $��	0,10,0,10q�6C   .��6V   请选择课内实验名称6a   &   System.Windows.Controls.DataGrid  5	      -   5        $��datagrid��5	      $	��300��6+   $	��500��67      AutoGenerateColumns .     AlternatingRowBackground# � ��6`   	   
IsReadOnly	 . 
   CanUserAddRows
 .   J� 	AllowDrop .    Columns 5
      0  *System.Windows.Controls.DataGridTextColumn  5      ,  &System.Windows.Controls.DataGridColumn   Header$ 实验名称��6-      Width5  /System.Windows.Controls.DataGridLengthConverter$ * 6;   1  +System.Windows.Controls.DataGridBoundColumn   Binding 6E   �� *Course_Name+6g     5      $ 授课教师��6-   $ * 6;    6E   �� *Course_Teacher+6j   4  .System.Windows.Controls.DataGridTemplateColumn  5      $ 选择课程��61   $ * 6?      CellTemplate 5      �� 5   "   .R�5   &   �� -   5        
������ $��0,0,0,1q�5   [   .��6u   
选择>>6{   5   #   5      5      5      5      5      5      