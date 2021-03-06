USE [master]
GO
/****** Object:  Database [newWMS]    Script Date: 09/21/2018 14:27:04 ******/
CREATE DATABASE [newWMS] ON  PRIMARY 
( NAME = N'newWMS', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL10_50.SQLEXPRESS\MSSQL\DATA\newWMS.mdf' , SIZE = 2048KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'newWMS_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL10_50.SQLEXPRESS\MSSQL\DATA\newWMS_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [newWMS] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [newWMS].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [newWMS] SET ANSI_NULL_DEFAULT OFF
GO
ALTER DATABASE [newWMS] SET ANSI_NULLS OFF
GO
ALTER DATABASE [newWMS] SET ANSI_PADDING OFF
GO
ALTER DATABASE [newWMS] SET ANSI_WARNINGS OFF
GO
ALTER DATABASE [newWMS] SET ARITHABORT OFF
GO
ALTER DATABASE [newWMS] SET AUTO_CLOSE OFF
GO
ALTER DATABASE [newWMS] SET AUTO_CREATE_STATISTICS ON
GO
ALTER DATABASE [newWMS] SET AUTO_SHRINK OFF
GO
ALTER DATABASE [newWMS] SET AUTO_UPDATE_STATISTICS ON
GO
ALTER DATABASE [newWMS] SET CURSOR_CLOSE_ON_COMMIT OFF
GO
ALTER DATABASE [newWMS] SET CURSOR_DEFAULT  GLOBAL
GO
ALTER DATABASE [newWMS] SET CONCAT_NULL_YIELDS_NULL OFF
GO
ALTER DATABASE [newWMS] SET NUMERIC_ROUNDABORT OFF
GO
ALTER DATABASE [newWMS] SET QUOTED_IDENTIFIER OFF
GO
ALTER DATABASE [newWMS] SET RECURSIVE_TRIGGERS OFF
GO
ALTER DATABASE [newWMS] SET  DISABLE_BROKER
GO
ALTER DATABASE [newWMS] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
GO
ALTER DATABASE [newWMS] SET DATE_CORRELATION_OPTIMIZATION OFF
GO
ALTER DATABASE [newWMS] SET TRUSTWORTHY OFF
GO
ALTER DATABASE [newWMS] SET ALLOW_SNAPSHOT_ISOLATION OFF
GO
ALTER DATABASE [newWMS] SET PARAMETERIZATION SIMPLE
GO
ALTER DATABASE [newWMS] SET READ_COMMITTED_SNAPSHOT OFF
GO
ALTER DATABASE [newWMS] SET HONOR_BROKER_PRIORITY OFF
GO
ALTER DATABASE [newWMS] SET  READ_WRITE
GO
ALTER DATABASE [newWMS] SET RECOVERY FULL
GO
ALTER DATABASE [newWMS] SET  MULTI_USER
GO
ALTER DATABASE [newWMS] SET PAGE_VERIFY CHECKSUM
GO
ALTER DATABASE [newWMS] SET DB_CHAINING OFF
GO
USE [newWMS]
GO
/****** Object:  User [tccuser]    Script Date: 09/21/2018 14:27:04 ******/
CREATE USER [tccuser] FOR LOGIN [tccuser] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[UserAccount]    Script Date: 09/21/2018 14:27:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserAccount](
	[UserId] [int] IDENTITY(1001,1) NOT NULL,
	[EmployeeId] [nvarchar](15) NOT NULL,
	[Division] [nvarchar](50) NOT NULL,
	[Firstname] [nvarchar](50) NOT NULL,
	[Middlename] [nvarchar](50) NOT NULL,
	[Lastname] [nvarchar](50) NOT NULL,
	[AccessLevel] [nvarchar](50) NOT NULL,
	[Username] [nvarchar](50) NOT NULL,
	[Password] [nvarchar](50) NOT NULL,
	[Hint] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_UserAccount] PRIMARY KEY CLUSTERED 
(
	[UserId] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MPVInformation]    Script Date: 09/21/2018 14:27:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MPVInformation](
	[MPVId] [int] NOT NULL,
	[RequestType] [nvarchar](50) NOT NULL,
	[RequestDate] [datetime] NOT NULL,
	[RequesterId] [nvarchar](15) NOT NULL,
	[RequesterName] [nvarchar](150) NOT NULL,
	[Purpose] [nvarchar](300) NOT NULL,
	[RecommendingStatus] [nvarchar](15) NOT NULL,
	[ApprovedStatus] [nvarchar](15) NOT NULL,
	[ApprovedById] [nvarchar](15) NOT NULL,
	[ApprovedStatusDate] [datetime] NOT NULL,
	[ApprovalRemarks] [nvarchar](max) NOT NULL,
	[Status] [nvarchar](25) NOT NULL,
	[CreatedByUserId] [int] NOT NULL,
	[DateCreated] [datetime] NOT NULL,
	[ModifiedByUserId] [int] NOT NULL,
	[DateModified] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MPVDetails]    Script Date: 09/21/2018 14:27:06 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MPVDetails](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[MPVNo] [int] NOT NULL,
	[ProductCode] [nvarchar](50) NOT NULL,
	[Product] [nvarchar](150) NOT NULL,
	[Specification] [nvarchar](150) NOT NULL,
	[Measurement] [nvarchar](50) NOT NULL,
	[Quantity] [decimal](18, 1) NOT NULL,
	[POQuantity] [decimal](18, 1) NOT NULL,
	[Remarks] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_MPVDetails] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  View [dbo].[vMPVDetails]    Script Date: 09/21/2018 14:27:06 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vMPVDetails]
AS
SELECT     dbo.MPVDetails.Id, dbo.MPVDetails.MPVNo, dbo.MPVInformation.RequestType, dbo.MPVInformation.RequestDate, dbo.MPVInformation.RequesterId, 
                      dbo.MPVInformation.RequesterName, dbo.MPVInformation.Purpose, dbo.MPVInformation.RecommendingStatus, dbo.MPVInformation.ApprovedStatus, 
                      dbo.MPVInformation.ApprovedById, dbo.MPVInformation.ApprovedStatusDate, dbo.MPVInformation.ApprovalRemarks, dbo.MPVInformation.Status, 
                      dbo.MPVDetails.ProductCode, dbo.MPVDetails.Product, dbo.MPVDetails.Specification, dbo.MPVDetails.Measurement, dbo.MPVDetails.Quantity, 
                      dbo.MPVDetails.POQuantity, dbo.MPVDetails.Remarks, dbo.MPVInformation.RequesterName AS Expr1
FROM         dbo.MPVDetails INNER JOIN
                      dbo.MPVInformation ON dbo.MPVDetails.MPVNo = dbo.MPVInformation.MPVId
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "MPVDetails"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 335
               Right = 208
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "MPVInformation"
            Begin Extent = 
               Top = 6
               Left = 246
               Bottom = 335
               Right = 452
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vMPVDetails'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vMPVDetails'
GO
/****** Object:  Default [DF_UserAccount_EmployeeId]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[UserAccount] ADD  CONSTRAINT [DF_UserAccount_EmployeeId]  DEFAULT ('') FOR [EmployeeId]
GO
/****** Object:  Default [DF_MPVInformation_RequestDate]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_RequestDate]  DEFAULT (getdate()) FOR [RequestDate]
GO
/****** Object:  Default [DF_MPVInformation_RecommendingStatus]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_RecommendingStatus]  DEFAULT (N'PENDING') FOR [RecommendingStatus]
GO
/****** Object:  Default [DF_MPVInformation_ApprovedStatus]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_ApprovedStatus]  DEFAULT (N'PENDING') FOR [ApprovedStatus]
GO
/****** Object:  Default [DF_MPVInformation_ApprovedById]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_ApprovedById]  DEFAULT ('') FOR [ApprovedById]
GO
/****** Object:  Default [DF_MPVInformation_ApprovedStatusDate]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_ApprovedStatusDate]  DEFAULT (getdate()) FOR [ApprovedStatusDate]
GO
/****** Object:  Default [DF_MPVInformation_Status]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_Status]  DEFAULT (N'FLOAT') FOR [Status]
GO
/****** Object:  Default [DF_MPVInformation_DateCreated]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_DateCreated]  DEFAULT (getdate()) FOR [DateCreated]
GO
/****** Object:  Default [DF_MPVInformation_DateModified]    Script Date: 09/21/2018 14:27:05 ******/
ALTER TABLE [dbo].[MPVInformation] ADD  CONSTRAINT [DF_MPVInformation_DateModified]  DEFAULT (getdate()) FOR [DateModified]
GO
