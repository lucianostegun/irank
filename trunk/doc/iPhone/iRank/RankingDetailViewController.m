//
//  RankingDetailViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingDetailViewController.h"
#import "EditableTableViewCell.h"
#import "iRankAppDelegate.h"

@implementation RankingDetailViewController
@synthesize ranking;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    
    //    [rankingName setText:ranking.rankingName];
    //    [rankingType setText:ranking.rankingType];
    //    [gameStyle setText:ranking.gameStyle];
    //    //    [credit setText:ranking.credit];
    //    [startDate setText:ranking.startDate];
    //    [finishDate setText:ranking.finishDate];
    //    [isPrivate setText:ranking.isPrivate];
    //    [defaultBuyin setText:ranking.defaultBuyin];
    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self 
     selector:@selector(keyboardWillAppear:) 
     name:UIKeyboardWillShowNotification 
     object:nil];
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    return 2;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    int rows = 0;
    switch( section ){
        case 0:
            rows = 7;
            break;
        case 1:
            rows = 4;
            break;
        default:
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    NSString *CellIdentifier = [NSString stringWithFormat:@"CellSection%i", indexPath.section];
    
    EditableTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil) {
        if( indexPath.section==0 )
            cell = [[[EditableTableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
        else
            cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
    
    if( indexPath.section==0 ){
        
        cell.detailTextLabel.font = [UIFont systemFontOfSize:15];
        
        switch (indexPath.row) {
            case 0:
                cell.leftLabel.text = @"Nome";
                cell.rightTextField.text = [ranking.rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.delegate = self;
                cell.selectionStyle = UITableViewCellEditingStyleNone;
                break;
            case 1:
                cell.leftLabel.text = @"Estilo";
                cell.rightTextField.text = [ranking.gameStyle stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                break;
            case 2:
                cell.leftLabel.text = @"Inicio";
                cell.rightTextField.text = [ranking.startDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                break;
            case 3:
                cell.leftLabel.text = @"Término";
                cell.rightTextField.text = [ranking.finishDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                break;
            case 4:
                cell.leftLabel.text = @"Exibição";
                cell.rightTextField.text = [ranking.isPrivate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                break;
            case 5:
                cell.leftLabel.text = @"Classificação";
                cell.rightTextField.text = [ranking.rankingType stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                break;
            case 6:
                cell.leftLabel.text = @"Buy-in padrão";
                cell.rightTextField.text = [ranking.defaultBuyin stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.delegate = self;
                cell.selectionStyle = UITableViewCellEditingStyleNone;
                break;
            default:
                break;
        }
    }else{
        
        switch (indexPath.row) {
            case 0:
                cell.textLabel.text = @"Jogadores";
                break;
            case 1:
                cell.textLabel.text = @"Eventos";
                break;
            case 2:
                cell.textLabel.text = @"Classificação";
                break;
            case 3:
                cell.textLabel.text = @"Opções";
                break;
            default:
                break;
        }
        
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    }
    
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView 
titleForHeaderInSection:(NSInteger)section {
    
    NSString *title = nil;
    
    switch (section) {
        case 0:
            title = @"Informações principais";
            break;
        case 1:
            title = @"Informações adicionais";
            break;
            break;
        default:
            break;
    }
    
    return title;
}

/*
 // Override to support conditional editing of the table view.
 - (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the specified item to be editable.
 return YES;
 }
 */

/*
 // Override to support editing the table view.
 - (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
 {
 if (editingStyle == UITableViewCellEditingStyleDelete) {
 // Delete the row from the data source
 [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
 }   
 else if (editingStyle == UITableViewCellEditingStyleInsert) {
 // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
 }   
 }
 */

/*
 // Override to support rearranging the table view.
 - (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
 {
 }
 */

/*
 // Override to support conditional rearranging of the table view.
 - (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the item to be re-orderable.
 return YES;
 }
 */

#pragma mark - Table view delegate

-(void)keyboardWillAppear:(NSNotification *)notification {
    
    [self dismissDatePicker:datePicker];
}

- (void)dismissDatePicker:(id)sender {

    self.navigationItem.leftBarButtonItem = nil;
    self.navigationItem.rightBarButtonItem = nil;
    
    CGRect datePickerTargetFrame = CGRectMake(0, self.view.bounds.size.height+44, 320, 216);
    [UIView beginAnimations:@"MoveOut" context:nil];
    datePicker.frame = datePickerTargetFrame;
    [UIView setAnimationDelegate:self];
    [UIView setAnimationDidStopSelector:@selector(removeDatePickerViews:)];
    [UIView commitAnimations];

    self.navigationItem.hidesBackButton = NO;
    datePicker.hidden = YES;
}

- (void)changeDate:(id)sender {

    NSLog(@"New Date: %@", datePicker.date);
    [self dismissDatePicker:datePicker];
}


- (void)removeDatePickerViews:(id)object {
    
    [datePicker removeFromSuperview];
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    [[self view] endEditing:YES];
    
    if( !datePicker.isHidden )
        return;
    
    datePicker.hidden = NO;
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    [appDelegate.window addSubview:datePicker];
    
    // size up the picker view to our screen and compute the start/end frame origin for our slide up animation
    //
    // compute the start frame
    CGRect screenRect = [[UIScreen mainScreen] applicationFrame];
    CGSize pickerSize = [datePicker sizeThatFits:CGSizeZero];
    CGRect startRect = CGRectMake(0.0,
                                  screenRect.origin.y + screenRect.size.height,
                                  pickerSize.width, pickerSize.height);

    datePicker.frame = startRect;
    
    // compute the end frame
    CGRect pickerRect = CGRectMake(0.0,
                                   screenRect.origin.y + screenRect.size.height - pickerSize.height,
                                   pickerSize.width,
                                   pickerSize.height);
    
    // start the slide up animation
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    
    // we need to perform some post operations after the animation is complete
    [UIView setAnimationDelegate:self];
    
    datePicker.frame = pickerRect;
    
    [UIView commitAnimations];
    
    UIBarButtonItem *doneButton   = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(changeDate:)];
    UIBarButtonItem *cancelButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemCancel target:self action:@selector(dismissDatePicker:)];
    
    self.navigationItem.hidesBackButton = YES;
    self.navigationItem.leftBarButtonItem  = cancelButton;
    self.navigationItem.rightBarButtonItem = doneButton;
    [doneButton release];
    [cancelButton release];
}

-(BOOL)textFieldShouldReturn:(UITextField *)textField {
    
    [textField resignFirstResponder];
    
    return YES;
}

-(void)dealloc {
    
    [ranking release];
    [datePicker release];
    [super dealloc];
}

@end
